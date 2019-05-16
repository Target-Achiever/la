<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Controllers\CommonController;

// use App\Http\Requests;

use Illuminate\Http\Request;

use App\RegistrationCount;

use Auth;

use App\User;

use App\User_detail;

use App\User_answer;

use App\BookAppointment;

use NumberFormatter;

// use Request;

use App\Notifications;



use App\AdminSettings;



use App\MailChimp;

use App\PaymentHistory;

use App\LaPaymentHistory;

use App\Advertisement;

use Hash;
use App\SeoTitleSettings;
use App\SeoPages;
use App\SeoWeb;

use App\Services;

use App\Blog;


class SuperAdminController extends Controller

{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        $this->middleware('auth');

    }

	/**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $name="Super admin";

        $active_user=User::where('user_type','=','end_user')

            ->where('user_status','=','active')->get();



        $active_provider=User::where ('users.administrator_approval','=','1')

            -> where (function ($query){

                $query  -> where( 'users.user_type', '=', 'prescriber' )

                    -> orWhere( 'users.user_type', '=', 'non_prescriber' );

            })

            ->where('user_status','=','active')

            -> whereNull ('users.deleted_at')->get();



        $pending_provider=User::join('user_answers', 'users.id', '=', 'user_answers.user_id' )

            ->where ('users.administrator_approval','=','2')

            -> where (function ($query){

                $query  -> where( 'users.user_type', '=', 'prescriber' )

                        -> orWhere( 'users.user_type', '=', 'non_prescriber' );

            })

            ->where('user_status','=','active')

            -> whereNull ('users.deleted_at')->get();

        $adearnings = PaymentHistory::where('payment_type',2)->where('payment_status',1)->sum('amount');   

        $apearnings = LaPaymentHistory::where('payment_status',1)->sum('la_share_amount');

        $earnings = (int)$adearnings + (int)$apearnings;

        return view('admin.dashboard',compact('name','active_user','active_provider','pending_provider','earnings'));    

    }
    public function profile()
    {

        $user = Auth::user();

        $profile = User::where('id',$user->id)->where('user_type','super_admin')->select('name','photo')->first();


        return view('admin/profile',compact('profile'));
    }

    public function save_profile(Request $request)
    {

        $data = $request->all();
        $this->validate($request,[
                                'user_name' => 'required'
                              ]);
        //---------------------------------------------------------------

        
        $userid = Auth::user()->id;

       

        $userInfo= User::where('users.id',$userid)->first();

        if(!empty($data['new_password']))

        {
            $this->validate($request,[

                                'new_password'     => 'required|min:6',

                                'confirm_password' => 'required|same:new_password'

                                

                            ]);
            //-------------------------------------validation
            if(HASH::check($data['old_password'],$userInfo->password))
            {
            }
            else
            {

                return redirect('admin/profile')->with('success','danger|Entered old password is not valid');

            }

        }
                //---upload user profile img

                $photo = $userInfo->photo;

                if ($request->hasFile('profile')) {
                    
                    $file = $data['profile'];

                    $photo = $userid."_".time().'.'.$request->profile->getClientOriginalExtension();

                    $request->profile->move(public_path('uploads/profile_photos'), $photo); 

                }



                $userInfo->password = (!empty($data['new_password'])) ? bcrypt($data['new_password']) : $userInfo->password;

                $userInfo->photo = $photo;

                $userInfo->name = $data['user_name'];

                $userInfo->save();
        //-----------------------------------------------

        
        return redirect('admin/profile')->with('success','success|Profile has been successfully updated');

    }


    /**

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function notification(){



          $provider = Auth::user()->id;

        $notifications = Notifications::leftJoin('users','notifications.notify_action_from','=','users.id')

            ->select('notifications.*','users.name as action_from')

            ->where('notifications.notify_action_to','=',$provider)

            ->where('notify_status', '=', '2' )

            ->orderBy('notifications.id','desc')->paginate(10);//notify_status- 2 =  not views notifications





        foreach ($notifications as $key => $value)

        {

           $register_count = RegistrationCount::where('user_id',$value->notify_action_from)
               ->select('user_registration_count.count as registration_count')
               ->orderby('created_at','desc')->first();
                $val = "";

                if($register_count) {
                    if ( $register_count->registration_count >= 2 ) {

                        /*$count = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );

                        $val = $count -> format($register_count->count)." times - ";*/

                        $val = "Rejected user ";

                    }
                }

           $value['notification_message'] = ucfirst($val).ucfirst($value->action_from)." - ".$value->notify_message;



        }

        return view('admin.notification',compact('notifications'));

    }



    /**

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function providerAppointment(){



        $providerAppointment = BookAppointment::join('users','users.id','=','appointment.provider_id' )

            -> where (function ($query){

                $query  -> where( 'users.user_type', '=', 'prescriber' )

                    -> orWhere( 'users.user_type', '=', 'non_prescriber' );

            })

            ->get();



        return view('admin.provider_appointment',compact('providerAppointment'));

    }



    /**

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function userAppointment(){



        $userAppointment = BookAppointment::join('users','users.id','=','appointment.user_id' )

            ->where( 'users.user_type', '=', 'end_user' )

            ->get();



        return view('admin.user_appointment',compact('userAppointment'));

    }

    public function appointment_history()
    {
        $appointment_history = BookAppointment::leftJoin('users','appointment.user_id','=','users.id')
                                  ->leftJoin('users as provider','appointment.provider_id','=','provider.id')
                                  ->leftJoin('services','appointment.service_needed','=','services.services_id')
                                  ->leftJoin('services as cat','services.category','=','cat.services_id')
                                  ->select('appointment.*','users.name','provider.name as provider_name','services.service','cat.service as category')
                                  ->whereIn('appointment_type',[1,2])->get();


                                  
        $status_array = array('1'=>'Request','2'=>'Accepted','3'=>'Declined','4'=>'Cancelled by requester','5'=>'Cancelled by Prescriber','6' => 'Auto cancel due to no payment');
                           
                                  
        return view('admin.appointment_history',compact('appointment_history','status_array'));                          

    }



    /**

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function paymentHistory(){



        $paymentHistory = BookAppointment::join('users','users.id','=','appointment.user_id' )

            ->where( 'users.user_type', '=', 'end_user' )

            ->get();



        return view('admin.payment_history',compact('paymentHistory'));

    }



       /**

     * @return \Illuminate\Http\JsonResponse

     */

    public function notificationCount(){



        $userid = Auth::user()->id;

        $count = Notifications::where('notify_action_to',$userid)

            ->where('notify_status', '=', '2')->count();



        return response()->json(['count' => $count]);

    }



    public function notificationAjax(Request $request, $noti_id, $noti_from)

    {

        $users = User::where('id',$noti_from)->get();



        CommonController::notificationViewed($noti_id);

        return view('modal-body.user_register_notify',compact('users'));



    }

    public function get_home_header_text(Request $request)

    {

        $data = AdminSettings::first();



        // print_r($data);die;

    

        return view('modal-body.admin_header_text',compact('data'));



    }

    public function home_header_text(Request $request)

    {

        $data = $request->input();

        AdminSettings::updateOrCreate(['id' => $data['id']],$data);



        return redirect('/')->with('success','success|Home header text has been successfully addedd');



    }

    public function business_data(Request $request)

    {

        //-------------------------------------end users
        $users = MailChimp::leftJoin('users','mail_chimp_info.user_id','=','users.id')
                            //->where('users.business_status','=','1')
                            ->where('users.administrator_approval','=','1')
                            ->select('mail_chimp_info.*','users.user_status','administrator_approval')
                            ->get();

        $users_list['end_user'] = $users_list['provider']  = array();

        foreach ($users as $key => $user) {
              if($user->user_type == 1)  
              $users_list['end_user'][] = $user;  
              else
              $users_list['provider'][] = $user;  
        }

        $user_status = array('active' => 'Active','in_active' => 'Not activated','1' => 'Admin approved','2' => 'Admin approval pending','3' => 'User rejected by admin');
        return view('admin.business_mails',compact('users_list','user_status'));



    }
     public function search(){

        $provider_list = User::leftJoin('user_details', 'users.id', '=', 'user_details.user_id' )
            -> where (function ($query){
                $query  -> where( 'users.user_type', '=', 'prescriber' )
                    -> orWhere( 'users.user_type', '=', 'non_prescriber' );
            })
            ->groupBy('user_details.country')
            ->whereNotNull('user_details.country')
            ->where('users.administrator_approval','=','1')
            ->select('user_details.country')
            ->get();


        return view('modal-body.search',compact('provider_list'));

    }
     public function appointment_payment(Request $request)
    {
        $appPayment = PaymentHistory::leftJoin('appointment','payment_history.paid_for_id','=','appointment.id')
                      ->leftJoin('users','appointment.provider_id','=','users.id')
                      ->leftJoin('services','appointment.service_needed','=','services.services_id')
                      ->select('payment_history.*','appointment.preferred_date','services.service','users.name','payment_history.payment_type')
                      ->where('payment_history.payment_type',1)
                      ->orWhere('payment_history.payment_type',3)
                      ->where('payment_history.payment_status',1)->get();
                      

        return view('admin.appointment_payment',compact('appPayment'));              
    }

    public function advertisement_payment(Request $request)
    {
        $adPayment = Advertisement::leftJoin('users','advertisement.user_id','=','users.id')
                      ->leftJoin('services','advertisement.service','=','services.services_id')
                      ->leftJoin('payment_history','advertisement.payment_id','=','payment_history.id')
                      ->select('advertisement.*','users.name','services.service','payment_history.transaction_id','payment_history.payment_date')
                      ->where('advertisement.ad_payment_status',1)
                      ->get();

        return view('admin.advertisement_payment',compact('adPayment'));               
    }

    public function chart_users_flow(Request $request)
    {

          $userss = User::get()->groupBy(function($item)
              {
                return $item->created_at->format('Y-m');
              });
              
           $array['cols'][] = array('type' => 'string','label' => 'Months');
           $array['cols'][] = array('type' => 'number','label' => 'Clients');
           $array['cols'][] = array('type' => 'number','label' => 'Prescribed providers');
           $array['cols'][] = array('type' => 'number','label' => 'Non Prescribed providers');

          foreach($userss as $key => $val)
          {
            $user_count = $userss[$key]->where('user_type','end_user')->count();

            $prescriber_count = $userss[$key]->where('user_type','prescriber')->count();

            $nonprescriber_count = $userss[$key]->where('user_type','non_prescriber')->count();

            $array['rows'][]['c'] = array(
                array('v' => $key),
                array('v' => $user_count),
                array('v' => $prescriber_count),
                array('v' => $nonprescriber_count)
            );
            
          }

          

          return response()->json($array);

    }
    public function adminSetting(){

        $setting = AdminSettings::where('type','=','home_page')->first();

        return view('admin.admin_setting',compact('setting'));
    }
    public function saveSetting($type){

        $data['home_page'] = $type;
        $data['type'] = 'home_page';
        AdminSettings::updateOrCreate(['type' => 'home_page'],$data);


        return response($data);
    }

    //-----------------------seo
    public function seo_settings(Request $request){

    	$data = $request->all();

    	/*--------------------------------Setting Insert-------------------------------------*/

    	if(isset($data['setting'])){

    $this->validate($request,[
                                'site_name' => 'required',
                                'title_separator' => 'required'
                              ]);
 

    	SeoTitleSettings::create( $data );
    }
      /*--------------------------------Home title Insert-----------------------------------*/
    if(isset($data['home']) || isset($data['pages']))
    {

    	
    	$this->validate($request,[
                                'title' => 'required',
                                'keyword' => 'required',
                                'description'=>'required',
                                'page'=>'required'
                              ]);

         if($data['page'] == 2 || $data['page'] == 3)
         {

         $result = SeoPages::where('page', '=', $data['page'])->where('sub_topic','=',$data['sub_topic'])->get();
       }
       else
       {

        $result = SeoPages::where('page', '=', $data['page'])->get();
       }

        if(isset($result) && count($result) > 0)
        {
        	return redirect('admin/seo')->with('success','danger|Page details already exists');
        }

       

    	SeoPages::create( $data );
    	//print_r($insert);  exit;
    }

    if(isset($data['web'])){

    	$this->validate($request,[
                                'web_master' => 'required',
                                'verification_code' => 'required'
                              ]);

    	$result = SeoWeb::where('web_master', '=', $data['web_master'])->get();

        if(isset($result) && count($result) > 0)
        {
        	return redirect('admin/seo')->with('success','danger|Details already exists for this webmaster');;
        }

    	SeoWeb::create( $data );
    }

    	 
         	return redirect('admin/seo')->with('success','success|Added successfully');

   }

   public function seo_settings_update(Request $request,$id){


   	    $data = $request->all();

   	    unset($data['_method']);
        
        unset($data['_token']);

        if(isset($data['setting'])){

        unset($data['setting']);

   	  $this->validate($request,[
                                'site_name' => 'required',
                                'title_separator' => 'required'
                              ]);

   	   
   	    SeoTitleSettings::where('id', '=', $id)->update($data);

     	}

      /*--------------------------------Home title update-----------------------------------*/
    if(isset($data['home']) || isset($data['pages']))
    {
    	unset($data['home']);
    	unset($data['pages']);

    $this->validate($request,[
                                'title' => 'required',
                                'keyword' => 'required',
                                'description'=>'required',
                                'page'=>'required'
                              ]);

    	

    	 SeoPages::where('id', '=', $id)->update($data);
    	//print_r($insert); 
    }

    if(isset($data['web'])){

    	unset($data['web']);

    	$this->validate($request,[
                                'web_master' => 'required',
                                'verification_code' => 'required'
                              ]);

    	SeoWeb::where('id', '=', $id)->update($data);
    }

   	return redirect('admin/seo')->with('success','success|Updated successfully');


   }

   public function seo_page(Request $request){

   	$data = $request->all();

   
   	$arr = Array();

   $result = SeoPages::where('id', '=', $data['id'])->get();

   foreach ($result as $key => $value) {

   	$arr['id'] =  $value->id;
   	$arr['page'] =  $value->page;
   	$arr['title'] =  $value->title;
   	$arr['keyword'] =  $value->keyword;
   	$arr['description'] =  $value->description;
    $arr['sub_topic'] =  $value->sub_topic;
  
   }

   echo json_encode($arr);  
   	
   }

   public function seo_page_delete(Request $request){

   	$data = $request->all();

   	if($data['type'] == 'page')
   	{

   	$result = SeoPages::where('id', '=', $data['id'])->delete();

   }

   else
   {

   	$result = SeoWeb::where('id', '=', $data['id'])->delete();
   }

   	$return['status'] = TRUE;
   	$return['message'] = 'Deleted';

   	return response()->json($return);

   }

   public function seo_web_view(Request $request){

   	$data = $request->all();

   
   	$arr = Array();

   $result = SeoWeb::where('id', '=', $data['id'])->get();

   foreach ($result as $key => $value) {

   	$arr['id'] =  $value->id;
   	$arr['web_master'] =  $value->web_master;
   	$arr['verification_code'] =  $value->verification_code;
  
   }

   echo json_encode($arr);  
   	
   }

   public function seo_topic(Request $request)
   {

      $data = $request->all();

      if($data['id'] == 2)
      {

      $blog = Blog::where( 'blog_status', '=', '1' )->get();

      $options = array('Select' => 'Please select');
      if($data["sub_topic"] != "")
      {
      $html = '<div class="form-group"><label>Select Topic</label><select class="form-control" disabled name="sub_topic" id="sub_topic"><option value="0">Main Page</option>';
      }
      else
      {
      $html = '<div class="form-group"><label>Select Topic</label><select class="form-control" name="sub_topic" id="sub_topic"><option value="0">Main Page</option>';
      }
       
      foreach ($blog as $key => $value) {
       //$options += array($value->id => $value->blog_header);
        if($value->id == $data["sub_topic"])
        {
          $select  = "selected";
        }
        else
        {
          $select = "";
        }
      $html.='<option value="'.$value->id.'"'.$select.'>'.$value->blog_header.'</option>';
      }
      $html.= '</select></div>';
      }
      else
      {

      $services=Services::where (function ($query){ $query -> where('service_type','=','4')
            -> orWhere('service_type','=','1'); })->get();

      if($data["sub_topic"] != "")
      {
      $html = '<div class="form-group"><label>Select Topic</label><select class="form-control" disabled name="sub_topic" id="sub_topic"><option value="0">Main Page</option>';
      }
      else
      {
      $html = '<div class="form-group"><label>Select Topic</label><select class="form-control" name="sub_topic" id="sub_topic"><option value="0">Main Page</option>';
      }

      foreach ($services as $key => $value) {
         if($value->services_id == $data["sub_topic"])
        {
          $select  = "selected";
        }
        else
        {
          $select = "";
        }
         //$options += array($value->services_id => $value->service);

         $html.='<option value="'.$value->services_id.'"'.$select.'>'.$value->service.'</option>';
      }

       $html.= '</select></div>';
      }

      echo $html;

   }
   public function seo_index(){

    $setting = SeoTitleSettings::first();

    $home_page = SeoPages::where('page', '=', 0)->first();

    $pages = SeoPages::where('page', '!=', 0)->get();

    $web = SeoWeb::all();

    $blog = Blog::where( 'blog_status', '=', '1' )->get();

    $services=Services::where (function ($query){ $query -> where('service_type','=','4')
            -> orWhere('service_type','=','1'); })->get();


    return view('admin.seo',compact('setting','home_page','pages','web','blog','services'));
   }


}


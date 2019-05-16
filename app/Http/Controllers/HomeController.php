<?php



namespace App\Http\Controllers;

// use App\Http\Requests;

use App\Disclaimer;
use App\GainProvider;

use App\Provider_refund_policy;

use Auth;



use App\User;

use App\Blog;

use App\StatusService;



use App\ProviderServices;



use App\User_detail;



use App\User_answer;



use App\BookAppointment;



use App\Services;



use App\Notifications;



use App\ProviderGallery;



use App\Feedback;



use Hash;



use Carbon\Carbon;



use Illuminate\Http\Request;



use Prophecy\Argument;



use Support\Collections;



use App\Http\Controllers\CommonController;



use \Illuminate\Pagination\LengthAwarePaginator;



use DB;



use App\Advertisement;



use App\Provider_policy;



use App\About;



use App\Subscribe;



use App\AdminSettings;

use Mail;

class HomeController extends Controller

{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    protected $statusService;



    public function __construct(StatusService $statusService)

    {
        $seo = new LaSeoController();
        $this->statusService = $statusService;

    }



    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {



        $ads = Advertisement::leftJoin('users','advertisement.user_id','=','users.id')

                              ->leftJoin('user_details','users.id','=','user_details.user_id')

                              ->leftJoin('services','advertisement.service','=','services.services_id')

                              ->select('advertisement.*','users.name','users.photo','users.user_slug','services.service','user_details.address_line_2 as address','user_details.city')

                              ->where('ad_status',1)

                              ->where('ad_payment_status',1)

                              ->whereDate('advertisement.period_from','<=', Carbon::today())

                              ->whereDate('advertisement.period_to', '>=', Carbon::today())

                              ->get();



         $services = Services::where('service_status','=','1')

             ->where('service_type','=','1')

             ->orWhere('service_type','=','4')

             ->orderBy('created_at','DESC')->get();



        $headerText = AdminSettings::where('status','=','1')
            ->orderBy('updated_at','desc')
            ->get()
            ->unique('type');

        $setting = AdminSettings::where('type','=','home_page')->first();

        return view('welcome',['name'=>"home"],compact('ads','services','headerText','setting'));

    }

		

	public function aboutUs()

    { 

        $aboutUs = About::all();



        return view('about_us',compact('aboutUs'));

    }

	public function blog()

    { 
       $blog = Blog::where('blog_status','=','1')->orderBy('created_at','=','DESC')
            ->get();
        return view('blog',['name'=>'blog','blog'=>$blog]);

    }

	public function services()

    {

        $gain = GainProvider::where('status','=','1')->take(3)->orderBy('created_at','DESC')->get();

		$services=Services::where (function ($query){ $query -> where('service_type','=','4')
            -> orWhere('service_type','=','1'); })->get();



        return view('services',compact('services','gain'));

		

    }

    public function blog_single_page(Request $request,$blog)

    {

       $blog = Blog::where('id','=',$blog)->get()->toArray();
       $blog_list = Blog:: where('blog_status','=','1')->get();

       return view('blog_single',compact('blog','blog_list'));

    }



    public function user_account()

    {

        $user = Auth::user()->id;

        //-------------------------------------------------profile data

        $profile = User::leftJoin('user_details','users.id','=','user_details.user_id')

                   ->select('users.name','users.email','users.photo','user_details.phone','user_details.country','user_details.state','user_details.city','user_details.address_line_1')

                   ->where('users.id','=',$user)->first();

        //-------------------------------------------------appointment data

        $appointments = BookAppointment::leftJoin('services','appointment.service_needed','=','services.services_id')

            ->leftJoin('services as cat','services.category','=','cat.services_id')

            ->leftJoin('users','appointment.provider_id','=','users.id')

            ->select('services.service','cat.service as service_name','users.name','appointment.*','services.service_type')

            ->where('appointment.user_id','=',$user)

            ->orderBy('appointment.id','desc')

            ->get();

        //-------------------------------------------------notifications

         $notifications = $this->notification($user);

        //-------------------------------------------------  

            $current = Carbon::now();

            $onehrbefore = $current->subHour(); //pay button only for the appointment date under current datetime-1hour

         foreach ($appointments as $key => $value) 

         {

            $value['payment_url'] = \Crypt::encrypt('appointment-'.$value->id);

            $value['paybutton'] = ($current->lt(Carbon::parse($value->preferred_date.''.$value->appointment_time_from)->subHour()) && $value->payment_status == 2) ? "true" : "false";

            $value['cancel_button'] = ($value->appointment_status != 3 && $value->appointment_status != 4 && $value->appointment_status != 5) ? true : false;

         }



        $feedback = Feedback::join('users' ,'users.id' ,'=' ,'feedback.provider_id' )

            ->select('feedback.created_at','feedback.feedback','users.name','users.photo','feedback.id as fb_id')

            ->where('feedback.status', '=' ,'2' )

            ->where('feedback.user_id' ,'=' ,$user)

            ->orderBy('feedback.created_at','DESC')

            ->limit(4)

            ->get()
            ->toarray();

        $feedback_count = Feedback::where('user_id' ,'=' ,$user)
            ->where('feedback.status', '=' ,'2' )
            ->get();
        //-------------------------------------------------

         $status_array = array('1'=>'Request','2'=>'Accepted','3'=>'Declined','4'=>'Cancelled by requester','5'=>'Cancelled by Prescriber','6' => 'Auto cancel due to no payment');

        return view('user_account',compact('profile','appointments','feedback_count','notifications','current','feedback','status_array'));

    }



    /**

     * @param Request $request

     */

    public function user_feedback(Request $request)

    {

        $user_id = Auth::user()->id;

        $inputs = $request->all();

        $data = array ();

        $output="";

        if( $inputs ){

           $data['feedback'] = $inputs['feedback'];

           $data['provider_id'] = $inputs['provider_id'];

           $data['user_id'] = $user_id;

           $data['status'] = '2';

           $data['feedback_type'] = '1';

           Feedback::create($data);

            $feedback = Feedback::join('users' ,'users.id' ,'=' ,'feedback.user_id' )
                ->leftJoin('users as provider','feedback.provider_id','=','provider.id')
                ->select('feedback.*','users.name','users.photo','users.email','provider.email as provider_mail')
                ->where('feedback.status', '=' ,'2' )
                ->orderBy('feedback.created_at','DESC')->first();

          //---------------------------------------------feedback mail
             Mail::send('emails.feedback_provider', ['name' => Auth::user()->name,'content' => $feedback],function ($m) use ($feedback){
                            $m->from('Info@linkaesthetics.com', 'LinkAesthetics');

                            $m->to($feedback->provider_mail)->subject('Feedback');
            });
            //------------------
             Mail::send('emails.feedback_user', ['name' => Auth::user()->name,'content' => $feedback],function ($m) use ($feedback){
                            $m->from('Info@linkaesthetics.com', 'LinkAesthetics');

                            $m->to($feedback->email)->subject('Feedback');
            });
            //----------------------------------------------------------      



            if( $feedback ){

                   if($feedback->photo){

                        $image=' <img alt="" class="img-circle" src="../uploads/profile_photos/'.$feedback->photo.'" /> ';

                   } else{

                       $image='<h2>'.mb_substr($feedback->name, 0, 1) .'</h2>';

                   }

                   $output .= '<div class="col-md-12 col-sm-12 feedback-list">

                                         <div class="com-md-2 col-sm-2 text-center">

                                           '.$image.'

                                            <h5>' .$feedback->name. '</h5>

                                            <h6>' .Feedback::timeAgo($feedback->created_at). '</h6>

                                         </div>

                                         <div class="com-md-10 col-sm-10">

                                             <div class="feed-msg">

                                                 <p> '. $feedback->feedback . ' </p>

                                             </div>

                                         </div>

                                     </div>';



            }

        }





        return Response($output);

    }

    public function user_feedback_save(Request $request)

    {

        $userid = Auth::user()->id;

        $create = Feedback::create([

                                        'feedback' => $request->input('feedback'),

                                        'user_id' => $userid

                                    ]);

        return redirect('feedback')->with('success','success|Your valuable feedback has been forwarded');

    }

    public function notification($user)

    {

        

        $notifications = Notifications::leftJoin('users','notifications.notify_action_from','=','users.id')

                        ->select('notifications.*','users.name as action_from')

                        ->where('notify_action_to','=',$user)

                        ->where('notify_status',2)

                        ->orderBy('notifications.id','desc')

                        ->get();//notify_status- 2 =  not views notifications





            foreach ($notifications as $key => $value) 

        {

            // switch ($value->notify_action_type) 

            // {

            //  case '1':

                    $notifications[$key]->notification_message = ucfirst($value->action_from)." ".$value->notify_message;

            //      break;

                

            //  default:

            //      $notifications[$key]->notification_message = "You have a notification";

            //      break;

            // }        

        }   

        return $notifications;

    }

    public function user_account_profile_save(Request $request)

    {

        $data = $request->input();

        $userid = Auth::user()->id;

       

        $userInfo= User::where('users.id',$userid)->first();



                            



        if(!empty($data['new_password']))

        {

                 //-------------------------------------validation

            $this->validate($request,[

                                'new_password'     => 'required|min:6',

                                'confirm_password' => 'required|same:new_password'

                                

                            ]);



            if(HASH::check($data['old_password'],$userInfo->password))

            {



            }

            else

            {

                return redirect('my-account')->with('success','danger|Entered old password is not valid');

            }

        }

                //---upload user profile img

                $photo = $userInfo->photo;

                if ($request->hasFile('profile')) {



                    $photo = $userid."_".time().'.'.$request->profile->getClientOriginalExtension();



                    // //-----------------------resize

                    // $destinationPath = public_path('uploads/profile_photos');

                    // $img = Image::make($request->profile->getRealPath());

                    // $img->resize(150, 100, function ($constraint) {

                    //     $constraint->aspectRatio();

                    // })->save($destinationPath.'/'.'thumb_'.$photo);



                    // //----------------------------

                    

                    $request->profile->move(public_path('uploads/profile_photos'), $photo); 

                }



                $userInfo->password = (!empty($data['new_password'])) ? bcrypt($data['new_password']) : $userInfo->password;

                $userInfo->photo = $photo;

                if ($userInfo->getUserDetails) 

                {

                    $userInfo->getUserDetails->phone = (!empty($data['phone'])) ? $data['phone'] :  $userInfo->getUserDetails->phone;

                    $userInfo->getUserDetails->country = (!empty($data['user_country'])) ? strtolower($data['user_country']) :  $userInfo->getUserDetails->country;

                    $userInfo->getUserDetails->state = (!empty($data['user_state'])) ? strtolower($data['user_state']) :  $userInfo->getUserDetails->state;

                    $userInfo->getUserDetails->city = (!empty($data['user_city'])) ? strtolower($data['user_city']) :  $userInfo->city;

                    $userInfo->getUserDetails->address_line_1 = (!empty($data['user_address'])) ? $data['user_address'] :  $userInfo->getUserDetails->address_line_1;

                    $userInfo->getUserDetails->location_string = $userInfo->getUserDetails->city.','.$userInfo->getUserDetails->state.','.$userInfo->getUserDetails->country;

                    $userInfo->getUserDetails->save();

                }



                $userInfo->save();



            



        //-----------------------------------------------

        return redirect('my-account')->with('success','success|Profile has been successfully updated');

        

    }



    public function notification_ajax(Request $request,$noti_id,$noti_type)

    {

      



        switch ($noti_type) {

            case '1':

            case '2':

                $appointment = Notifications::leftJoin('appointment','notifications.notify_action_id','=','appointment.id')

                      ->leftJoin('users','appointment.provider_id','=','users.id')

                      ->leftJoin('user_details','users.id','=','user_details.user_id')

                      ->leftJoin('services','appointment.service_needed','=','services.services_id')

                      ->leftJoin('services as cat','services.category','=','cat.services_id')

                      ->select('notifications.id as notiId','appointment.*','services.service','users.name as user_name','users.email as user_email','users.photo','user_details.phone as user_contact','cat.service as service_name','cat.service_type')

                      ->where('notifications.id','=',$noti_id)->first();//return data with provider details

                      $appointment['payment_url'] = \Crypt::encrypt('appointment-'.$appointment->id);

                      //-----------------------------------------------update notification table

                      CommonController::notificationViewed($noti_id);



                      $status_array = array('1'=>'Request','2'=>'Accepted','3'=>'Declined','4'=>'Cancelled by requester','5'=>'Cancelled by Prescriber','6' => 'Auto cancel due to no payment');

                      

                      return view('modal-body.notiview',compact('appointment','status_array'));

                break;

            

            default:

                return view('provider.nodatafound');

                break;

        }

        

    }

    public function remove_notification(Request $request,$noty_id)

    {

        $userId = Auth::user()->id; 



        $count = Notifications::where('notify_action_to', $userId)

                                ->where('id',$noty_id)->count();

        if($count == 1)//check whether the user has rights to remove the data

        {

            Notifications::where('id', $noty_id)->delete();

        }else

        {

            return response()->json(array("status"=>"false","message"=>"Not an authorized user/invalid input"));

        }



        return response()->json(array("status"=>"true","message"=>"Notification removed"));

    }



    public function search(Request $request)//home page search

    {

        $data = $request->input();

        //----------------------------------------check user login status

        $user_login_status = 0;

        if (Auth::check()) {

            $user_login_status = 1;

        }

        //-----------------------------------------------------------------------------------

        if($request->input('search')!=''){



            $searchresult = array("location" => $data['search'],"service" => $data['service']);

            //---------------------------------------------------------------------------------

            if($data['latitude'] == '' && $data['longitude'] == '')//no latlong parameter

            {

                $data['latitude'] = 0;

                $data['longitude'] = 0;

            }



            $location = explode(',', $data['search']);

            

            //------------------------------------------------------------------

            $where = " AND (services.service='".$data['service']."' OR users.name LIKE '%".$data['service']."%') AND FIND_IN_SET('".strtolower($location[0])."',location_string) AND users.administrator_approval='1' AND services.service IS NOT NULL AND provider_services.service_amount !=''";

            $joinfield = 'category';

            

            if($data['service'] == 'offers&deals')

            {

              $where = ' AND users.administrator_approval="1" AND services.service_type="2" AND provider_services.service_amount !=""';

              $joinfield = 'services_id';

            }

            //-------------------------------------------------------------------

            $lat = $data['latitude'];

            $lon = $data['longitude'];



            $providers = DB::select( DB::raw("SELECT users.name,users.id,users.user_slug,users.photo,user_details.forename,user_details.nationality,user_details.city,provider_services.user_id,provider_services.service_amount,services_settings.time_from,services_settings.time_to,provider_services.provider_services_id,provider_services.services_id as material_id,services.services_id,services.service,provider_gallery.file_name,3956 * 2 * ASIN(SQRT( POWER(SIN(($lat - latitude) * pi()/180 / 2), 2) + COS($lat * pi()/180) * COS(latitude * pi()/180) *POWER(SIN(($lon - longitude) * pi()/180 / 2), 2) )) as distance FROM user_details LEFT JOIN users ON(user_details.user_id = users.id) LEFT JOIN provider_services ON(users.id = provider_services.user_id) LEFT JOIN provider_gallery ON(users.id = provider_gallery.user_id) LEFT JOIN services ON(provider_services.$joinfield = services.services_id) LEFT JOIN services_settings ON(users.id = services_settings.user_id) WHERE (users.user_type='prescriber' OR users.user_type='non_prescriber') $where  GROUP BY users.id ORDER BY DISTANCE ASC LIMIT 0,4") );

            $queryString = \Crypt::encrypt("SELECT users.name,users.id,users.user_slug,users.photo,user_details.forename,user_details.nationality,user_details.city,provider_services.user_id,provider_services.service_amount,services_settings.time_from,services_settings.time_to,provider_services.provider_services_id,provider_services.services_id as material_id,services.services_id,services.service,provider_gallery.file_name,3956 * 2 * ASIN(SQRT( POWER(SIN(($lat - latitude) * pi()/180 / 2), 2) + COS($lat * pi()/180) * COS(latitude * pi()/180) *POWER(SIN(($lon - longitude) * pi()/180 / 2), 2) )) as distance FROM user_details LEFT JOIN users ON(user_details.user_id = users.id) LEFT JOIN provider_services ON(users.id = provider_services.user_id) LEFT JOIN provider_gallery ON(users.id = provider_gallery.user_id) LEFT JOIN services ON(provider_services.$joinfield = services.services_id) LEFT JOIN services_settings ON(users.id = services_settings.user_id) WHERE (users.user_type='prescriber' OR users.user_type='non_prescriber') $where GROUP BY users.id ORDER BY DISTANCE ASC LIMIT {offset},4");
            

            $providers = json_decode(json_encode($providers), true);



            

            //--------------------------------------------------------------------



            $user_ids =  array_column($providers, 'id');



            $providerList = array();



            foreach ($providers as $key => $value) 

            {

                

                if(!isset($providerList[$value['id']]))

                {

                    $amount = $value['service_amount'];

                    $service_id = $value['services_id'];

                    $service  = $value['service'];



                    unset($value['service'],$value['services_id'],$value['service_amount']);

                    if(!empty($service_id))

                    {

                        

                        $providerList[$value['id']] = $value;

                        $providerList[$value['id']]['provider_services']['service'][] = array("amount" => $amount,"service_id"=>$service_id,"service"=>$service);

                        if(isset($value['material_id']) && $value['material_id'] != '')
                        {
                          $material = Services::where("services_id",$value['material_id'])
                                      ->select('service')
                                      ->first(); 
                        $providerList[$value['id']]['provider_services']['material'] = array("name" => $material->service ,"amount" => $amount);
                          

                        }else
                        {
                          $providerList[$value['id']]['provider_services']['material'] = array();
                        }




                    }

                    else

                    {

                        $providerList[$value['id']] = $value;

                        $providerList[$value['id']]['provider_services']['service'] = array();
                        $providerList[$value['id']]['provider_services']['material'] = array();

                    }

                }else

                {

                    $providerList[$value['id']]['provider_services']['service'][] = array("amount" => $value['service_amount'],"service_id"=>$value['services_id'],"service"=>$value['service']);
$providerList[$value['id']]['provider_services']['material'] = array();

                }

                //--------------------get provider gallery

                $providerList[$value['id']]['provider_gallery'] = ProviderGallery::where('user_id','=',$value['id'])

                ->select('file_name')->get()->toArray();



            }    

            //---------------------------------------------------------------------------------

        }

        else{

            return redirect()->back()->with('success','danger|Oops! location missing');

        }



        // $page = $request->get('page', 1); // Get the current page or default to 1, this is what you miss!

        // $perPage = 4;

        // $offset = ($page * $perPage) - $perPage;



        // $providers =  new LengthAwarePaginator(array_slice($providerList, $offset, $perPage, true), count($providerList), $perPage, $page, ['path' => $request->url(), 'query' => $request->query()]);
        $providers = $providerList;
        //---------------------------------------------------------------



        return view('search',compact('providers','user_login_status','searchresult','queryString'));

    }

    public function ajax_search(Request $request)
    {
      $data = $request->all();
      $offset = $data['offset'];
      //----------------------------------------check user login status

        $user_login_status = 0;

        if (Auth::check()) {

            $user_login_status = 1;

        }

        //-----------------------------------------------------------------------------------
      
      //----------------------
      $data['queryString'] = str_replace('{offset}', $offset, \Crypt::decrypt($data['queryString']));
      $providers = DB::select( DB::raw($data['queryString']) );

      $providers = json_decode(json_encode($providers), true);

      //--------------------------------------------------------------------



            $user_ids =  array_column($providers, 'id');



            $providerList = array();



            foreach ($providers as $key => $value) 

            {

                

                if(!isset($providerList[$value['id']]))

                {

                    $amount = $value['service_amount'];

                    $service_id = $value['services_id'];

                    $service  = $value['service'];



                    unset($value['service'],$value['services_id'],$value['service_amount']);

                    if(!empty($service_id))

                    {

                        

                        $providerList[$value['id']] = $value;

                        $providerList[$value['id']]['provider_services']['service'][] = array("amount" => $amount,"service_id"=>$service_id,"service"=>$service);
if(isset($value['material_id']) && $value['material_id'] != '')
                        {
                          $material = Services::where("services_id",$value['material_id'])
                                      ->select('service')
                                      ->first(); 

                          $providerList[$value['id']]['provider_services']['material'] = array("name" => $material->service ,"amount" => $amount);
                          

                        }else
                        {
                          $providerList[$value['id']]['provider_services']['material'] = array();
                        }

                        



                    }

                    else

                    {

                        $providerList[$value['id']] = $value;

                        $providerList[$value['id']]['provider_services']['service'] = array();
                        $providerList[$value['id']]['provider_services']['material'] = array();


                    }

                }else

                {

                    $providerList[$value['id']]['provider_services']['service'][] = array("amount" => $value['service_amount'],"service_id"=>$value['services_id'],"service"=>$value['service']);
                        $providerList[$value['id']]['provider_services']['material'] = array();


                }

                //--------------------get provider gallery

                $providerList[$value['id']]['provider_gallery'] = ProviderGallery::where('user_id','=',$value['id'])

                ->select('file_name')->get()->toArray();



            }

            //----------------------------------------------------------------
            if(!empty($providerList))
            {

              return view('modal-body.ajax_search',compact('providerList','user_login_status','offset'));
            }
            else
            {
              return response()->json(false);
            }
    }
    // --------

    public function list_providers_services()//ajax call for location point click

    {

        $data = $_POST;



        $location = explode(',', $data['searchKey']);



        $where = " AND FIND_IN_SET('".strtolower($location[0])."',location_string) AND services.service IS NOT NULL";

        $lat = $data['lat'];

        $lon = $data['lon'];

        

        $prescribers = DB::select( DB::raw("SELECT 3956 * 2 * ASIN(SQRT( POWER(SIN(($lat - latitude) * pi()/180 / 2), 2) + COS($lat * pi()/180) * COS(latitude * pi()/180) *POWER(SIN(($lon - longitude) * pi()/180 / 2), 2) )) as distance,services.service FROM user_details LEFT JOIN users ON(user_details.user_id = users.id) LEFT JOIN provider_services ON(users.id = provider_services.user_id) LEFT JOIN services ON(provider_services.category = services.services_id) WHERE (users.user_type='prescriber' || users.user_type='non_prescriber') $where GROUP BY provider_services.category ORDER BY DISTANCE ASC") );



            

            return response()->json($prescribers);

        

        

    }

    public function get_search_result()//ajax call for datalist input search

    {

        

        $data = $_POST;

        $location = explode(',', $data['location']);



        if($data['location'] == '')//no latlong parameter

        {

            $ip = \Request::ip();

            $locationdata = \Location::get($ip);

            $data['lat'] = $locationdata->latitude;

            $data['lon'] = $locationdata->longitude;

        }



        $where = " AND FIND_IN_SET('".strtolower($location[0])."',location_string) AND (users.name LIKE '%".$data['searchKey']."%' OR services.service LIKE '%".$data['searchKey']."%') AND services.service IS NOT NULL";
        if($data['type'] == 'focus')
        {

          $where = " AND FIND_IN_SET('".strtolower($location[0])."',location_string) AND services.service IS NOT NULL";
        }

        $lat = $data['lat'];

        $lon = $data['lon'];

        

        $searchResult = DB::select( DB::raw("SELECT users.name,services.service,3956 * 2 * ASIN(SQRT( POWER(SIN(($lat - latitude) * pi()/180 / 2), 2) + COS($lat * pi()/180) * COS(latitude * pi()/180) *POWER(SIN(($lon - longitude) * pi()/180 / 2), 2) )) as distance,services.service FROM user_details LEFT JOIN users ON(user_details.user_id = users.id) LEFT JOIN provider_services ON(users.id = provider_services.user_id) LEFT JOIN services ON(provider_services.category = services.services_id) WHERE (users.user_type='prescriber' || users.user_type='non_prescriber') $where GROUP BY provider_services.category ORDER BY DISTANCE ASC") );



            

            return response()->json($searchResult);    

            // return json_decode(json_encode($searchResult), true);

                        



    }

    public function predefined_services_list(Request $request)

    {



        $services = Services::where('service_status',1)

                    ->where('service_type',1)->get();



        return response()->json($services);

    }

    public function get_provider_services()

    {

        $data = $_POST;



        $providers = array();

        if($data['action'] == 'get_provoders_services')

        {



            $providers = User::join('user_details', 'users.id', '=', 'user_details.user_id')

            ->select('users.id','user_details.latitude','user_details.longitude')

            ->where('users.user_type','=','prescriber')

            ->get(); 



            foreach ($providers as $key => $value) 

            {

                $providers[$key]['providers_services'] = ProviderServices::leftJoin('services', 'provider_services.services_id', '=', 'services.services_id')

                ->select('services.services_id','services.service')

                ->where('provider_services.user_id','=',$value->id)

                ->where('provider_services.service_status','=',1)

                ->get();

            }



        }



        $return['data'] = $providers;

        

            

        echo json_encode($providers);



    }

    /*

        list provider who all providing services for user clicked from home page read more services

    */

    public function list_service_providers(Request $request)//home page search

    {

    

            $serviceArray = explode('-', $request->route('serviceid'));



            $searchresult = array("location" => 'service',"service" => $serviceArray[1]);

            $service = $serviceArray[0];

            //--------------------------------------------------------------------
            \DB::enableQueryLog();
            $providers = User::leftJoin('user_details','users.id','=','user_details.user_id')

                              ->leftJoin('provider_services','users.id','=','provider_services.user_id')

                              ->leftJoin('provider_gallery','users.id','=','provider_gallery.user_id')

                              ->leftJoin('services','provider_services.category','=','services.services_id')

                              ->leftJoin('services_settings','users.id','=','services_settings.user_id')
->select('users.*','user_details.*','provider_services.*','services.*','services_settings.*','provider_services.services_id as material_id')

                              ->where('provider_services.category',$service)

                              ->where('provider_services.service_amount','!=','')

                              ->whereNotNull('services.service')

                              ->groupBy('users.id')

                              ->offset(0)
                              
                              ->limit(4)

                              ->get();
            $query = \DB::getQueryLog();
            
                             

            $queryString = \Crypt::encrypt("SELECT users.*,user_details.*,provider_services.*,provider_gallery.*,services.*,services_settings.*,provider_services.services_id as material_id from users LEFT JOIN user_details on (users.id=user_details.user_id) LEFT JOIN provider_services on (users.id=provider_services.user_id) LEFT JOIN provider_gallery on (users.id=provider_gallery.user_id) LEFT JOIN services on(provider_services.category=services.services_id) LEFT JOIN services_settings ON(users.id=services_settings.user_id) where provider_services.category = '".$service."' AND provider_services.service_amount !='' AND services.service IS NOT NULL GROUP BY users.id LIMIT {offset},4");              

            $providers = json_decode(json_encode($providers), true);

            //--------------------------------------------------------------------



            $user_ids =  array_column($providers, 'id');



            $providerList = array();



            foreach ($providers as $key => $value) 

            {

                

                if(!isset($providerList[$value['id']]))

                {

                    $amount = $value['service_amount'];

                    $service_id = $value['services_id'];

                    $service  = $value['service'];



                    unset($value['service'],$value['services_id'],$value['service_amount']);

                    if(!empty($service_id))

                    {

                        

                        $providerList[$value['id']] = $value;

                        $providerList[$value['id']]['provider_services']['service'][] = array("amount" => $amount,"service_id"=>$service_id,"service"=>$service);

                        if(isset($value['material_id']) && $value['material_id'] != '')
                        {
                          $material = Services::where("services_id",$value['material_id'])
                                      ->select('service')
                                      ->first(); 
                        $providerList[$value['id']]['provider_services']['material'] = array("name" => $material->service ,"amount" => $amount);
                          

                        }else
                        {
                          $providerList[$value['id']]['provider_services']['material'] = array();
                        }



                    }

                    else

                    {

                        $providerList[$value['id']] = $value;

                        $providerList[$value['id']]['provider_services']['service'] = array();
                        $providerList[$value['id']]['provider_services']['material'] = array();

                    }

                }else

                {

                    $providerList[$value['id']]['provider_services']['service'][] = array("amount" => $value['service_amount'],"service_id"=>$value['services_id'],"service"=>$value['service']);
$providerList[$value['id']]['provider_services']['material'] = array();

                }

                //--------------------get provider gallery

                $providerList[$value['id']]['provider_gallery'] = ProviderGallery::where('user_id','=',$value['user_id'])

                ->select('file_name')->get()->toArray();



            }    



        // $page = $request->get('page', 1); // Get the current page or default to 1, this is what you miss!

        // $perPage = 3;

        // $offset = ($page * $perPage) - $perPage;



        // $providers =  new LengthAwarePaginator(array_slice($providerList, $offset, $perPage, true), count($providerList), $perPage, $page, ['path' => $request->url(), 'query' => $request->query()]);

        $providers = $providerList;
        //----------------------------------------check user login status

        $user_login_status = 0;

        if (Auth::check()) {

            $user_login_status = 1;

        }

        //---------------------------------------------------------------



        return view('search',compact('providers','user_login_status','searchresult','queryString'));

    }

    //------------------------

    public function search_by_filter(Request $request)

    {

        $data =  $request->input();



        

        

        $providers = User::join('user_details', 'users.id', '=', 'user_details.user_id')

            ->select('users.name','users.id','users.photo','user_details.forename','user_details.nationality')

            ->where('users.user_type','=','prescriber')

            ->where('user_details.latitude','=',$data['latitude'])

            ->where('user_details.longitude','=',$data['longitude'])

            ->get(); 



        foreach ($providers as $key => $value) 

        {

            $providers[$key]['providers_services'] = ProviderServices::leftJoin('services', 'provider_services.services_id', '=', 'services.services_id')

            ->select('provider_services.service_amount','services.services_id','services.service')

            ->where('provider_services.user_id','=',$value->id)

            ->where('provider_services.service_status','=',1)

            ->where('services.service','=',$data['service'])

            ->get();

        }



        $page = $request->get('page', 1);

        $limit = 2;

        $paginator = new LengthAwarePaginator(

            $providers->forPage($page, $limit), $providers->count(), $limit, $page, ['path' => $request->path()]

        );



        return view('search',compact('paginator'));

    }

    public function set_appointment_id(Request $request)

    {

        $data = $request->input();

         session(['app_id' => $data['app_id']]);

    }



    public function provider_overview(Request $request,$provider)

    {



        $providerData= array();

        //---------------------------------------------

        $provider_info = User::join('user_details', 'users.id', '=', 'user_details.user_id')

            ->leftJoin('user_answers','users.id','=','user_answers.user_id')

            ->leftJoin('provider_services', 'provider_services.user_id', '=', 'users.id')

            ->leftJoin('services_settings', 'users.id', '=', 'services_settings.user_id')

            ->leftJoin('services', 'provider_services.services_id', '=', 'services.services_id')

            ->leftJoin('services as cat','provider_services.category', '=', 'cat.services_id')

            ->select('users.user_slug','users.name','users.photo','user_details.forename','user_details.nationality','user_details.latitude','user_details.longitude','user_details.address_line_1','user_details.city','user_details.state','user_details.country','provider_services.user_id','provider_services.service_amount','provider_services.service_offer','provider_services.service_actual_amount','provider_services.quantity','services.services_id','services.service','services_settings.time_from','services_settings.time_to','services_settings.available_days','service_location_preference','user_answers.registered_with','cat.service as categoryname','provider_services.service_type')

            ->where('services.service','!=','')

            ->where('users.user_slug','=',$provider)->get()->toArray();



            



        $provider_policies = User::join('provider_policies', 'users.id', '=', 'provider_policies.user_id')

            ->where('users.user_slug','=',$provider)
            ->orderBy('provider_policies.created_at','DESC')
            ->get()
            ->unique('policy_type');
            $providerData['provider_policies']=array ();

            if($provider_policies) {



                foreach ($provider_policies as $key => $value) {

                     $providerData['provider_policies'][] = array ( "policy" => $value->policy, "policy_type" => $value->policy_type );
                }

            }



            $providerData['provider_gallery']=array ();



        $provider_gallery = User::join('provider_gallery', 'users.id', '=', 'provider_gallery.user_id')

            ->where('users.user_slug','=',$provider)

            ->where('provider_gallery.status','=','1')

            ->get()

            ->toArray();



            foreach ($provider_gallery as $key => $value) {



                $providerData['provider_gallery'][] = array( 'file_name' => $value['file_name'],'original_path' => $value['original_path']);



            }



            foreach ($provider_info as $key => $value) {

                

                if(!isset($providerData[$value['user_id']]))

                {

                    // echo $key;

                    // echo "<br>";

                    $amount = $value['service_amount'];

                    $service_id = $value['services_id'];

                    $service  = $value['service'];

                    $offerstatus  = $value['service_offer'];

                    $actualamount  = $value['service_actual_amount'];

                    $quantity = $value['quantity'];

                    $service_type = $value['service_type'];



                    unset($value['service'],$value['services_id'],$value['service_amount'],$value['service_offer'],$value['service_actual_amount'],$value['quantity'],$value['service_type']);

                    if(!empty($service_id))

                    {

                

                        $providerData['providerInfo'] = $value;

                        $indexkey = ($value['categoryname'] != '' ) ? $value['categoryname'] : 'Deals';

                        $providerData['provider_services'][$indexkey][] = array("amount" => $amount,"service_id"=>$service_id,"service"=>$service,'offer' => $offerstatus,'actual_amount' => $actualamount,'volume'=> $quantity,'type'=>$service_type);



                    }

                    else

                    {

                        $providerData = $value;

                        $providerData['provider_services'] = array();

                    }

                }else

                {

                    $providerData[$value['id']]['provider_services'][] = array("amount" => $value['service_amount'],"service_id"=>$value['services_id'],"service"=>$value['service']);

                }

            }

            $services = $providerData['providerInfo'];

            unset($providerData['providerInfo']);



            $providerData = array_merge($providerData,$services);



            // return view('book_an_appointment',compact('providerData'));

        //--------------------------------------------



        $feedback = Feedback::join('users' ,'users.id' ,'=' ,'feedback.user_id' )

            ->select('feedback.created_at','feedback.feedback','users.name','users.photo','feedback.id as fb_id')

            ->where('feedback.status', '=' ,'2' )

            ->where('provider_id' ,'=' ,$providerData['user_id'])

            ->orderBy('feedback.created_at','DESC')

            ->limit(4)

            ->get()

            ->toarray();

        $feedback_count = Feedback::where('provider_id' ,'=' ,$providerData['user_id'])
            ->where('feedback.status', '=' ,'2' )
            ->get();

        //------------------------------------------------------------------

         $locationPreference = array("1" => "Provider location","2" => "Mobile","3" => "Flexible");

         //------------------------------------------------------------------



       $refund_policy = Provider_refund_policy::where('user_id',$providerData['user_id'])->first();

       if(Auth::user()) {
           $user = Auth::user()->id;

           $appointment = BookAppointment::where('user_id','=',$user)
               ->where('provider_id','=',$providerData['user_id'])
               ->where('payment_status','=','1')
               ->orderBy('created_at','desc')
               ->first();
       }else {

           $appointment = "";
       }

        return view('provider_overview',compact('providerData','feedback','feedback_count','locationPreference','refund_policy','appointment'));

    }

    

	public function get_appointment_list(Request $request,$user)//user side- while drop down menu clicks - ajax call

    {

        $data = $request->input();

        //-----------------------

        $appointment_info = BookAppointment::leftJoin('services','appointment.service_needed','=','services.services_id')

            ->leftJoin('users','appointment.provider_id','=','users.id')

            ->select('services.service','users.name','appointment.id as appid','appointment.user_id')

            ->where('appointment.user_id','=',$user)

            ->get();



        return view('modal-body.appointment_list',compact('appointment_info'));

    }

    public function get_appointment_details(Request $request,$appid,$userid)//user side - clicked one app from list

    {

        $data = $request->input();

        //-----------------------

        $app = BookAppointment::leftJoin('services','appointment.service_needed','=','services.services_id')

            ->leftJoin('users','appointment.provider_id','=','users.id')

            ->select('services.service','users.name','appointment.*')

            ->where('appointment.id','=',$appid)

            ->where('appointment.user_id','=',$userid)

            ->first();



        return view('appointment_details',compact('app'));

    }



    /**

     * @param Request $request

     * @param $app_id

     * @return string

     */

    public function cancelAppointment(Request $request, $app_id)

    {

        $user = Auth::user()->id;

        BookAppointment::where('id',$app_id)

                      ->update(['appointment_status' => '4','declined_by' => $user]);



        return  $status = 'true';

    }



    /**

     * @param $type

     */

    public function load_modal(Request $request, $type){



        $about=array ();

        $blog_type = $request->blog_type;



        if($type == "about"){

            $id = $request->id;

            $about = About::where('id','=',$id)->first();

        }

        if($type == 'services'){



           $service = Services::where('services_id', '=' ,$request->service_id )->get();

        }

        return view('modal-body.content',compact('type','about','blog_type' ,'service') );

    }

/**

     *

     */

    public function ServicesList(){



        $service = Services::where('service_status' ,'=' ,'1')

            ->get()

            ->toArray();

            $list=array();

            foreach ($service as $service_list){

                $list[] = $service_list['service'];

            }





        return response()->json($list);

    }

    /**

     * @param Request $request

     */

    public function SubScribe(Request $request){



        Subscribe::create($request->all());



        $this->statusService->sendSubscribeMail($request->subscribe_email,'LinkAesthetics subscribe','emails.subscribe');

        

        return redirect('home')->with('success','success|Thank you for subscribing.');

    }

    public function ServicesReadContent(Request $request, $serices_id){



        $service = Services::where('services_id',$serices_id)->first();

        $service_all = Services::where (function ($query){ $query -> where('service_type','=','4')
            -> orWhere('service_type','=','1'); })
            ->whereNotIn('services_id',[$serices_id])
            ->get(['services.service','services.services_id']);
        $setting = AdminSettings::where('type','=','home_page')->first();

        return view('services_list',compact('service','service_all','setting'));

    }

    /* 

        // provider edit profile aesthetic services and combo services

        //store provider multiple services as temporary

    */

    public static function service_multiselect_ajax_(Request $request)

    {

        $data = $request->all();

        $user = Auth::user();

        if($data['services_id']) {



            if ( count( $data['services_id'] ) <= 1 ) {

                if ( $request->ajax() ) {

                    return response()->json( array ( "status" => false, "message" => "Please make deals" ) );

                } else {

                    return $message = 'danger|Please make deals.';

                }

            }





            $service = Services::where( 'combination', implode( ',', $data['services_id'] ) )->first();



            $servicesInfo = Services::whereIn( 'services_id', $data['services_id'] )->lists( 'service' )->toArray();



            if ( $service === null ) {



                $create = Services::create( [ 'service' => implode( '&', $servicesInfo ), 'service_type' => 2,

                    'combination' => implode( ',', $data['services_id'] ), 'service_status' => 1 ] );



                $insertdata = array ( 'user_id' => $user->id, 'services_id' => $create->id, 'service_status' => 1, 'service_type' => 2 );

                if ( isset( $data['service_type'] ) ) {

                    $insertdata = array ( 'user_id' => $user->id, 'services_id' => $create->id,

                        'service_amount' => conversion_to_cent( $data['service_amount'] ),

                        'prescription_amount' => (isset( $data['prescription_amount'] )) ? conversion_to_cent( $data['prescription_amount'] ) : '',

                        'time_needed' => $data['time_needed'], 'service_status' => 1, 'service_type' => 2 );

                }





                $createservice = ProviderServices::create( $insertdata );





                if ( isset( $create->id ) ) {

                    if ( $request->ajax() ) {



                        return response()->json( array ( "status" => true, "id" => $createservice->id, 'service' => implode( '&', $servicesInfo ) ) );

                    } else {

                        return $message = 'success|Deals has been created successfully.';

                    }

                } else {

                    if ( $request->ajax() ) {

                        return response()->json( array ( "status" => false, "message" => "no deals created." ) );

                    } else {

                        return $message = 'danger|no deals created.';

                    }

                }

            } else {



                $providerservice = ProviderServices::where( 'services_id', $service->services_id )->where('user_id',$user->id)->count();



                if ( $providerservice > 0 ) {

                    if ( $request->ajax() ) {

                        return response()->json( array ( "status" => false, "message" => "Deals exist." ) );

                    } else {

                        return $message = 'danger|Deals exist.';

                    }

                }



                $insertdata = array ( 'user_id' => $user->id, 'services_id' => $service->services_id, 'service_status' => 1, 'service_type' => 2 );

                if ( isset( $data['service_type'] ) ) {

                    $insertdata = array ( 'user_id' => $user->id, 'services_id' => $service->services_id, 'service_amount' => conversion_to_cent( $data['service_amount'] ), 'prescription_amount' => (isset( $data['prescription_amount'] )) ? conversion_to_cent( $data['prescription_amount'] ) : '', 'time_needed' => $data['time_needed'], 'service_status' => 1, 'service_type' => 2 );

                }



                ProviderServices::create( $insertdata );



                if ( $request->ajax() ) {

                    return response()->json( array ( "status" => true, "id" => $service->services_id, 'service' => implode( '&', $servicesInfo ) ) );

                } else {

                    return $message = 'success|Deals has been created successfully.';

                }

            }



        }

        return response()->json( array ( "status" => false, "message" => "Select services" ) );

    }

    public static function service_multiselect_ajax(Request $request)

    {

        $data = $request->all();



        // print_r($data);die;

        

        $user_id = Auth::user()->id;



        $serviceCount = ProviderServices::leftJoin('services','provider_services.services_id','=','services.services_id')

              ->where('provider_services.user_id',$user_id)

              ->where('services.combination',strtolower(str_replace(' ', '',$data['aesthetic_combo_treatment'])));



        $serviceCount =  $serviceCount->count(); 

         

        if($serviceCount == 0)

        {               

            //------------------create material for particular service

            $creatematerial = Services::create( [ 'user_id' => $user_id,'service' => $data['aesthetic_combo_treatment'],'service_type' => 2,'service_status' => 1 ,'combination' =>strtolower(str_replace(' ', '', $data['aesthetic_combo_treatment']))] );

            //---------------------------------------------------------end  





           $insertdata = array ( 'user_id' => $user_id, 'services_id' => $creatematerial->id,'service_status' => 1, 'service_type' => 2 );



           $servicecreate = ProviderServices::create( $insertdata );



        }

        else

        {

            return response()->json( array ( "status" => false, "message" => "Deals exist." ) );

        }



        return response()->json( array ( "status" => true, "id" => $servicecreate->id, 'service' => $data['aesthetic_combo_treatment'] ) );

            

    }

    public function remove_combo(Request $request,$comboid)

    {

            

            //----------------------check service appointment status

            $appointmentexist = CommonController::check_appointment_exist($comboid);



            if($appointmentexist)

            {

              

              return response()->json(array("status" => false,"message" => "Sorry! This request cannot be processed, because an appointment has had for this service."));  

            }

            //-------------------------------------------------------------



            $user = Auth::user();



            $service =  ProviderServices::where('provider_services_id', $comboid)->first();



            $remove = ProviderServices::where('provider_services_id',$comboid)->delete();

                      Services::where('services_id', $service->services_id)->delete();



            if($remove)

            {

                return response()->json(array("status" => true,'id'=> $comboid));

            }

            else

            {

                return response()->json(array("status" => false,"message" => "deals not removed, please try again later."));

            }



    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function terms(){

        $terms = Disclaimer::where('type','=','2')->orderBy('updated_at','desc')->first();
        return view('terms',compact('terms'));
    }
    public function privacy_policy(){

        $privacy_policy = Disclaimer::where('type','=','3')->orderBy('updated_at','desc')->first();
        return view('privacy_policy',compact('privacy_policy'));
    }
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loadFeedback(Request $request){

        $id = $request->id;
        $type = $request->type;

        if($type == 'provider_overview'){

            $feedback = Feedback::join('users' ,'users.id' ,'=' ,'feedback.user_id' )

                ->select('feedback.created_at','feedback.feedback','users.name','users.photo','feedback.id as fb_id')
                ->where( 'feedback.id', '<', $id )
                ->where('feedback.status', '=' ,'2' )
                ->where('provider_id' ,'=', $request->provider_id )
                ->orderBy('feedback.created_at','DESC')
                ->limit(4)
                ->get()
                ->toarray();


        }elseif ($type =='user_account') {

            $user = Auth::user()->id;
            $feedback = Feedback::join( 'users', 'users.id', '=', 'feedback.provider_id' )
                ->select( 'feedback.created_at', 'feedback.feedback', 'users.name', 'users.photo', 'feedback.id as fb_id' )
                ->where( 'feedback.id', '<', $id )
                ->where( 'feedback.status', '=', '2' )
                ->where( 'feedback.user_id', '=', $user )
                ->orderBy( 'feedback.created_at', 'DESC' )
                ->limit( 4 )
                ->get()
                ->toarray();
        }


        return view('load_feedback',compact('feedback','type'));
    }
}


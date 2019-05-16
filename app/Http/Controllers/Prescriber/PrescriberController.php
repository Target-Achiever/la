<?php



namespace App\Http\Controllers\Prescriber;



use App\Feedback;

use App\Http\Controllers\Controller;



use App\Http\Requests;


use App\ProviderGallery;
use App\RegistrationCount;



use App\StatusMail;

use Illuminate\Support\Facades\Hash;
use Request;



use App\Http\Requests\ServicesSettingsRequest;



use App\Provider_refund_policy;



use App\Services;



use Illuminate\Http\Request as Requestss;



use Auth;



use App\User;



use App\BookAppointment;



use App\User_detail;



use App\User_answer;



use App\Provider_policy;



use App\ProviderServices;



use App\Notifications;



use App\ServicesSettings;



use DateTime;



use Carbon\Carbon;



use App\Http\Controllers\CommonController;



use App\StatusService;



use App\Professional;



use App\PaymentHistory;



use Mail;

use Config;

use App\BankAccount;

use App\LaPaymentHistory;



class PrescriberController extends Controller

{

    /**

     * Create a new controller instance.

     *

     * @return void

     */



    protected $statusService;



    public function __construct(StatusService $statusService)

    {

        $this->middleware('auth');

        $this->statusService = $statusService;

    }



	/**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    

    public function index(Request $request)

    { 

    	$userid = Auth::user()->id;

        $TotalNumberofUsers = BookAppointment::where('provider_id', $userid)->where('appointment_status', '=', '2')->count();


        $TotalAmount = LaPaymentHistory::where('user_id',$userid)
                        ->where('payment_status',1)
                        ->sum('amount');


       /* $TotalAmount = BookAppointment::where('provider_id',$userid)

            ->where('payment_status', '=', '1')

            ->where('appointment_status', '=', '2')

            ->sum('service_amount');*/

        $bankacStatus = BankAccount::where('user_id',$userid)->where('status',1)->count();


        return view('provider.dashboard', ['name'=>"super_admin"],
            compact('servicesSettings','providerServices', 'TotalAmount', 'TotalNumberofUsers','bankacStatus'));

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



    /**

     * @return \Illuminate\Http\JsonResponse

     */

    public function graphsContent(){



        $userid = Auth::user()->id;

        $count=array();

        for($i = 0; $i < 12; $i ++){

            $month=$i+1;

            $to_from = '2018-'.$month.'-31';

            $from_from = '2018-'.$month.'-01';

            $TotalNumberofUsers = BookAppointment::where('provider_id',$userid)

                ->whereBetween('preferred_date', [$from_from, $to_from])

                ->where('appointment_status', '=', '2')->count();

            $count['users'][$i] = $TotalNumberofUsers;

            $TotalAmount = BookAppointment::where('provider_id',$userid)

                ->whereBetween('preferred_date', [$from_from, $to_from])

                ->where('payment_status', '=', '1')

                ->where('appointment_status', '=', '2')

                ->sum('service_amount');


            $count['amount'][$i] = $TotalAmount * 100 / 100000 ;



        }



        return response()->json($count);

    }



    /**

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function becomeProvider()

    { 

        

		$page = 'provider';

        $user_id = Auth::user()->id;



        $user_detail=User::leftJoin('user_answers','user_answers.user_id','=','users.id')

            ->leftJoin('user_details', 'user_details.user_id' ,'=','users.id')

            ->leftJoin('provider_refund_policies', 'provider_refund_policies.user_id','=','users.id' )

            ->where('users.id','=',$user_id)

            ->select('user_answers.*','user_details.*','users.*','provider_refund_policies.*')->first();



        $services = Services::where('service_status',1)->where('service_type',1)->lists('service','services_id');



        $provider_services = ProviderServices::where('user_id',$user_id)->where('service_status',1)->where('service_type',1)->groupBy('category')->lists('category')->toArray();



        $provider_services = array_map(function($arr)

        {

                return (int)$arr;

        },$provider_services);

        //---------------------provider combo services

        $comboservices = ProviderServices::leftJoin('services','provider_services.services_id','=','services.services_id')

                        ->where('provider_services.user_id',$user_id)

                        ->where('provider_services.service_type',2)

                        ->where('provider_services.service_status',1)

                        ->select('provider_services.provider_services_id','services.service')

                        ->get(); 

        //-------------------------------------------end    



        $professional = Professional::where('status' ,'=' ,'1')->get();

        $professional_array['professional_title']['']='Select';



        if($professional) {

                    foreach ($professional as $professional_details) {

                        $professional_array['professional_title'][$professional_details->professional_title] = $professional_details->professional_title;

                    }

        }



        $aesthetic_service = Services::all();



        if($aesthetic_service) {

            foreach ($aesthetic_service as $aesthetic_services) {

                $aesthetic_services_array[$aesthetic_services->service] = $aesthetic_services->service;

            }

        }



        $user_answer = User_answer::where('user_id','=',$user_id)->first();

        $user_reject = User::where('id','=',$user_id)->first();



        return view('provider.become_a_provider' ,compact('user_id','page','user_detail',

          'aesthetic_treatment','professional_array','aesthetic_services_array','user_answer',

            'services','provider_services','comboservices','user_reject'));

		

    }

    /**

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function becomeProviderBackend()

    {



        $page = 'provider';

        $user_id = Auth::user()->id;



        $user_detail=User::leftJoin('user_answers','user_answers.user_id','=','users.id')

            ->leftJoin('user_details', 'user_details.user_id' ,'=','users.id')

            ->leftJoin('provider_refund_policies', 'provider_refund_policies.user_id','=','users.id' )

            ->where('users.id','=',$user_id)

            ->select('user_answers.*','user_details.*','users.*','provider_refund_policies.*')->first();



        $services = Services::where('service_status',1)->where('service_type',1)->lists('service','services_id');



        $provider_services = ProviderServices::where('user_id',$user_id)

            ->where('service_status',1)->where('service_type',1)

            ->groupBy('services_id')->lists('services_id')->toArray();

        $provider_services = array_map(function($arr){

            return (int)$arr;

        },$provider_services);

        //---------------------provider combo services

        $comboservices = ProviderServices::leftJoin('services','provider_services.services_id','=','services.services_id')

            ->where('provider_services.user_id',$user_id)

            ->where('provider_services.service_type',2)

            ->where('provider_services.service_status',1)

            ->select('provider_services.provider_services_id','services.service')

            ->get();

        //-------------------------------------------end



        $professional = Professional::where('status' ,'=' ,'1')->get();

        $professional_array['professional_title']['']='Select';



        if($professional) {

            foreach ($professional as $professional_details) {

                $professional_array['professional_title'][$professional_details->professional_title] = $professional_details->professional_title;

            }

        }



        $aesthetic_service = Services::all();



        if($aesthetic_service) {

            foreach ($aesthetic_service as $aesthetic_services) {

                $aesthetic_services_array[$aesthetic_services->service] = $aesthetic_services->service;

            }

        }



        $user_answer = User_answer::where('user_id','=',$user_id)->get();



        return view('provider.become_a_provider_backend' ,compact('user_id','page','user_detail',

            'aesthetic_treatment','professional_array','aesthetic_services_array','user_answer',

            'services','provider_services','comboservices'));



    }



    /**

     * @param Request $request

     * @return \Illuminate\Http\RedirectResponse

     */

    public function saveProviderBackend(Request $request){



        $user_id = Auth::user()->id;

        $inputs = Request::all();

        $user_data =array ();

        $data['surname'] = $inputs['surname'];

        $user_data['name'] = $inputs['name'];

        $data['address_line_2'] = $inputs['address_line_2'];

        $address = $inputs['address_line_2'].",".$inputs['city'].",".$inputs['state'].",".$inputs['country'].",".$inputs['post_code'];

        $data['location_string'] =strtolower( preg_replace('/\s*,\s*/', ',', $address));

        $data['country'] = $inputs['country'];

        $data['state'] = $inputs['state'];

        $data['city'] = $inputs['city'];

        $data['post_code'] = $inputs['post_code'];

        $data['latitude'] = $inputs['latitude'];

        $data['longitude'] = $inputs['longitude'];

        $data['phone'] = $inputs['phone'];

        $data['business'] = $inputs['business'];

        $data['business_address'] = $inputs['business_address'];

        $user['photo'] = '';



        User_detail::where('user_id',$user_id)->update($data);



        $type = "success";

        $message = "Profile has been updated.";



        $userInfo= User::where('id',$user_id)->first();



        if(!empty($inputs['new_password']))
        {
            //-------------------------------------validation

            if(HASH::check($inputs['old_password'],$userInfo->password))

            {

                $this->validate(request(),[

                    'new_password'     => 'required|min:6',

                    'confirm_password' => 'required|same:new_password'

                ]);



                $user_data['password'] = (!empty($inputs['new_password'])) ? bcrypt($inputs['new_password']) : $userInfo->password;


                return redirect('provider/become_a_provider_backend')

                    ->with('success','success|Password has been updated');

            }
            else
            {
                return redirect('provider/become_a_provider_backend')

                    ->with('success','danger|Entered old password is not valid');

            }

        }
        User::where('id',$user_id)->update($user_data);


        return redirect('provider/become_a_provider_backend')

            ->with('success',$type.'|'.$message);



    }

    /**

     * @param Request $request

     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector

     */

    public function saveProvider(Request $request)

    {

        $user_id = Auth::user()->id;

        $inputs = Request::all();



        if(isset($inputs['declaration'])){



            $data['user_id'] = $user_id;

            $data['title'] = $inputs['title'];

            $data['surname'] = $inputs['surname'];

            $data['forename'] = $inputs['forename'];

            $data['date_of_birth'] = $inputs['date_of_birth'];

            $data['nationality'] = $inputs['nationality'];

            //$data['address_line_1'] = $inputs['address_line_1'];

            $data['address_line_2'] = $inputs['address_line_2'];

            $address = $inputs['address_line_2'].",".$inputs['city'].",".$inputs['state'].",".$inputs['country'].",".$inputs['post_code'];

            $data['location_string'] =strtolower( preg_replace('/\s*,\s*/', ',', $address));

            $data['country'] = $inputs['country'];

            $data['state'] = $inputs['state'];

            $data['city'] = $inputs['city'];

            $data['post_code'] = $inputs['post_code'];

            //$data['zip'] = $inputs['zip'];

            $data['latitude'] = $inputs['latitude'];

            $data['longitude'] = $inputs['longitude'];



            $data['phone'] = $inputs['phone'];

            $data['business'] = $inputs['business'];

            $data['business_address'] = $inputs['business_address'];

            $user['photo'] = '';

            $user['prescribing_rights']="";





            if (Request::hasFile('photo')) {


                $data_image = $inputs['provider_profile'];

                list( $type, $data_image ) = explode( ';', $data_image );

                list( , $data_image ) = explode( ',', $data_image );

                $data_image = base64_decode( $data_image );

                $user['photo'] = $user_id."_".time() . '.png';

                file_put_contents( public_path( 'uploads/profile_photos/' . $user['photo'] ), $data_image );

               /* $file = Request::file("photo");

                $photo = $user_id."_".time().'.'.$file->getClientOriginalExtension();

                $user['photo'] = $photo;

                $file->move(public_path('uploads/profile_photos'), $photo);*/



            } else{



                $userprofile = User::where('id', '=', $user_id)->get();

                $user['photo'] = $userprofile[0]['photo'];

            }



            User_detail::updateOrCreate(['user_id' => $user_id],$data);



            if(isset($inputs["prescribing_rights"])){



                if($inputs['prescribing_rights'] != "non_prescriber"){



                    $user['prescribing_rights'] = 'prescriber';

                }

                else{



                    $user['prescribing_rights'] = 'non_prescriber';

                }

            }



            $userinfo = User::find($user_id);

            $userinfo->user_type = $user['prescribing_rights'];

            $userinfo->photo = $user['photo'];

            $userinfo->save();



            $qa_fields = array('uk','other_uk', 'uk_qualification', 'other_uk_qualification', 'professional',

                'other_professional', 'registered_with', 'professional_pin','other_professional_pin', 'aesthetic_training' ,

                'aesthetic_training_date', 'insurance_company_name', 'insurance_policy_number', 'prescribing_rights',

                'other_aesthetic_training','aesthetic_treatment', 'other_prescribing_rights','registration_number');

            $certificate_fields=array('identity','address_proof','medical_qualification','rights_prescribe',

                'aesthetic_training_certificate','insurance_certificate','other_certificate');



            foreach($qa_fields as $qa_field){



                if(isset($inputs["$qa_field"])){



                    $user_answer_data["$qa_field"] = $inputs["$qa_field"];

                    if($qa_field == 'aesthetic_treatment'){

                        $user_answer_data["$qa_field"] = implode(',',$inputs["$qa_field"]);

                    }

                }

            }



            $i = 1;

            foreach($certificate_fields as $certificate_field){



                if (Request::hasFile("$certificate_field")) {



                    $files = Request::file("$certificate_field");

                    $certificate = $user_id."_".$i."_".time().'.'.$files->getClientOriginalExtension();

                    $files->move(public_path('uploads/providers'), $certificate);



                    $user_answer_data["$certificate_field"] = $certificate;

                }

                $i++;

            }

            if($userinfo->administrator_approval == 3){

                $count = RegistrationCount::where('user_id',$user_id)->orderBy('created_at','DESC')->first();



                RegistrationCount::create(['user_id' => $user_id,'count' => $count->count + 1 ]);

                User::where('id' , $user_id)->update(['administrator_approval' => '2']);

            }else{

                RegistrationCount::create(['user_id' => $user_id, 'count' => '1']);

            }

            User_answer::updateOrCreate(['user_id' => $user_id],$user_answer_data);



            $cancel_policies['refund']=$inputs['refund'];

            $cancel_policies['percentage_week']=$inputs['percentage_week'];

            $cancel_policies['percentage_days']=$inputs['percentage_days'];

            $cancel_policies['percentage_appointment_day'] = $inputs['percentage_appointment_day'];



            Provider_refund_policy::updateOrCreate(['user_id' => $user_id],$cancel_policies);

            // -------------------------------------------------------create provider services

            $serviceinput = $existing_services = array();



            // $ids = ProviderServices::where('user_id','=',$user_id)

            //             ->where('service_type',1)

            //             ->whereIn('services_id',$inputs['aesthetic_treatment'])

            //             ->select('services_id')

            //             ->get()->toArray();

            $ids = ProviderServices::where('user_id',$user_id)

                             ->where('service_type',1)

                             ->where('service_status',1) 

                             ->select('category')->get()->toArray();                            

            if($ids != null)

            {            

                $existing_services = array_map(function($arr){

                return $arr['category'];

                },$ids);

            }    

            foreach ($inputs['aesthetic_treatment'] as $key => $id) {



                if(!in_array($id,$existing_services))

                {   

                    

                    $createservice = Services::create( [ 'user_id' => $user_id, 'category' => $id,'service_type' => 3,'service_status' => 1 ] );



                    $serviceinput[] = array('user_id' => $user_id,'services_id' => $createservice->id,'service_status' => 1,'service_type' => 1,'category' => $id);



                }

            }

            if(!empty($serviceinput))

                ProviderServices::insert($serviceinput);

            //--------------------------------------------------------------------------------

        }

        //exit;

        /* email & notification*/

        $admin_status_text = "Thank you registration. Waiting for admin approval.";

        $this->statusService->sendStatusMail($user_id,$admin_status_text,'Waiting for admin approval','emails.submitdocument');



        StatusMail::create(['user_id' => $user_id,'status_template' => $admin_status_text,

            'status_type' => 'active' ]);



        CommonController::superAdminNotification(Auth::user(),'Submitted document.','5');

        $page = 'become_a_provider';

        return redirect('provider/become-a-provider')

            ->with('success','success|Profile has been updated');

    }



    /**

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function notification()

	{



		$provider = Auth::user()->id;

		$notifications = Notifications::leftJoin('users','notifications.notify_action_from','=','users.id')

						->select('notifications.*','users.name as action_from')

						->where('notifications.notify_action_to','=',$provider)

                                                ->where('notifications.notify_status','=','2')

                        ->orderBy('notifications.id','desc')->paginate(10);//notify_status- 2 =  not views notifications

                        

        

			foreach ($notifications as $key => $value) 

		{

			// switch ($value->notify_action_type) 

			// {

			// 	case '1':

					$value['notification_message'] = ucfirst($value->action_from)." ".$value->notify_message;

			// 		break;

				

			// 	default:

			// 		$notifications[$key]->notification_message = "You have a notification";

			// 		break;

			// }		

		}	

		return view('provider/notification',compact('notifications'));

	}



    /**

     * @param Request $request

     * @param $noti_id

     * @param $noti_type

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function notification_ajax(Request $request, $noti_id, $noti_type)

	{

		switch ($noti_type) {

            case '1':

                $appointment = Notifications::leftJoin('appointment','notifications.notify_action_id','=','appointment.id')

                    ->leftJoin('users','appointment.user_id','=','users.id')

                    ->leftJoin('user_details','users.id','=','user_details.user_id')

                    ->leftJoin('services','appointment.service_needed','=','services.services_id')

                    ->leftJoin('services as cat','services.category','=','cat.services_id')

                    ->select('notifications.id as notiId','appointment.*','services.service','users.name as user_name','users.email as user_email','users.photo','user_details.phone as user_contact','cat.service as service_name','cat.service_type')

                    ->where('notifications.id','=',$noti_id)->first();//return data with provider details

            case '2':

                $appointment = Notifications::leftJoin('appointment','notifications.notify_action_id','=','appointment.id')

                      ->leftJoin('users','appointment.user_id','=','users.id')

                      ->leftJoin('user_details','users.id','=','user_details.user_id')

                      ->leftJoin('services','appointment.service_needed','=','services.services_id')

                      ->leftJoin('services as cat','services.category','=','cat.services_id')

                      ->select('notifications.id as notiId','appointment.*','services.service',

                          'users.name','users.email','users.photo','user_details.phone','cat.service as service_name','cat.service_type')

                      ->where('notifications.id','=',$noti_id)->first();//return data with provider details



                $current = Carbon::now();

                $onehrbefore = $current->subHour(); //pay button only for the appointment date under current datetime-1hour

        

                $appointment['paybutton'] = ($current->lt(Carbon::parse($appointment->preferred_date.''.$appointment->appointment_time_from)->subHour()) && Auth::user()->user_type == 'non_prescriber' && $appointment->payment_status == 2) ? "true" : "false";

                $appointment['payment_url'] = \Crypt::encrypt('appointment-'.$appointment->id);

         

                      $status_array = array('1'=>'Request','2'=>'Accepted','3'=>'Declined','4'=>'Cancelled by requester','5'=>'Cancelled by Prescriber','6' => 'Auto cancel due to no payment');

                      //-----------------------------------------------update notification table

                      CommonController::notificationViewed($noti_id);

                      return view('modal-body.notiview',compact('appointment','status_array'));

                break;



            case '3'://payment history

                        $payment_history = Notifications::leftJoin('payment_history','notifications.notify_action_id','=','payment_history.id')

                            ->leftJoin('appointment','payment_history.paid_for_id','=','appointment.id')

                            ->leftJoin('services','appointment.service_needed','=','services.services_id')

                            ->select('payment_history.transaction_id','appointment.*','services.service')

                            ->where('notifications.id',$noti_id)

                            ->first();

                      CommonController::notificationViewed($noti_id);

                      //--------------------------------------------      

                      return view('modal-body.app_payment_notify',compact('payment_history'));      

            break;



            default:

                return view('provider.nodatafound');

                break;

            }

		

	}

    public function appointment_view(Request $request,$appid)

    {

            $appointment = BookAppointment::leftJoin('users','appointment.user_id','=','users.id')

                    ->leftJoin('user_details','users.id','=','user_details.user_id')

                    ->leftJoin('services','appointment.service_needed','=','services.services_id')

                    ->select('appointment.*','services.service',

                        'users.name','users.email','user_details.phone')

                    ->where('appointment.id','=',$appid)->first();//return data with provider details



                $current = Carbon::now();

                $onehrbefore = $current->subHour(); //pay button only for the appointment date under current datetime-1hour



                $appointment['paybutton'] = ($current->lt(Carbon::parse($appointment->preferred_date.''.$appointment->appointment_time_from)->subHour()) && Auth::user()->user_type == 'non_prescriber' && $appointment->payment_status == 2) ? "true" : "false";

                $appointment['payment_url'] = \Crypt::encrypt('appointment-'.$appointment->id);



                $status_array = array('1'=>'Request','2'=>'Accepted','3'=>'Declined','4'=>'Cancelled by requester','5'=>'Cancelled by Prescriber','6' => 'Auto cancel due to no payment');

                //-----------------------------------------------update notification table

                return view('modal-body.notiview',compact('appointment','status_array'));

    }



    /**

     * @param Request $request

     * @param $app_id

     * @param $status

     * @param $noti_id

     * @return \Illuminate\Http\RedirectResponse

     */

    // public function appointment_result(Request $request, $app_id, $status, $noti_id)

    public function appointment_result(Request $request, $app_id, $status)

	{

	

		$user = Auth::user()->id;



        $appointment = BookAppointment::leftJoin('users','appointment.user_id','=','users.id')

                                        ->leftJoin('services','appointment.service_needed','=','services.services_id')

                                        ->leftJoin('services as cat','services.category','=','cat.services_id')

                                        ->select('appointment.*','users.name','users.email','services.service','cat.service as service_name','services.service_type')

                                        ->where('provider_id',$user)

                                        ->where('appointment.id',$app_id)->first();



        if($appointment === null)//check function doing by authorized user or not

        {

            return redirect()->back()->with('success', 'danger|Not an authorized user/invalid input');

        }         

        //------------------------------------------check appointment time is less than current time-1hour

        $current = Carbon::now();

        $onehrbefore = $current->subHour(); //pay button only for the appointment date under current datetime-1hour



        if($current->lt(Carbon::parse($appointment->preferred_date.''.$appointment->appointment_time_from)->subHour()))

            {



            }else

            {

                return redirect()->back()->with('success', 'danger|Appointment date is too close to the current time, so we are avoiding it from you.');

            }

            

        //-----------------------------------------------------------

        $actiondone = $declined_by = '';

        $declineIds = array();

        if($status = 2)//appointment status changed to accepted

        {

            $actiondone = 'accepted';



            $admin_status_text='Your Appointment has been accepted,Thank you';



            //-----------------------------------------------if the request is accepted

            $apps = BookAppointment::where('provider_id','=',$user)//get all appointment requests exclude current request

                         ->where('preferred_date','=',$appointment->preferred_date)

                         ->where('appointment_status','=',1)

                         ->where('id','!=',$app_id)

                         ->where('preferred_date', '>=', date('Y-m-d'))

                         ->select('appointment.id','appointment.appointment_time_from','appointment.appointment_time_to')->get(); 



            foreach($apps as $app)//decline all requests which all times comes between current request

            {

                //-------------------------------------------------convert the time to 24hrs format

                $checkTfrom = DateTime::createFromFormat('H:i', $app->appointment_time_from);

                $checkTto = DateTime::createFromFormat('H:i', $app->appointment_time_to);

                $bookedFromD = DateTime::createFromFormat('H:i', $appointment->appointment_time_from);

                $bookedToD = DateTime::createFromFormat('H:i',$appointment->appointment_time_to);



                //----------------------------------------------------condition

                if ($checkTfrom >= $bookedFromD && $checkTfrom <= $bookedToD || ($checkTto >= $bookedFromD && $checkTto <= $bookedToD))//check whether the time comes under the booked time schedule

                {

                    $declineIds[] = $app->id;//get ids to decline

                    $data[] = [

                                    'notify_action_id' => $app->id,

                                    'notify_action_type' => 1,//user-provider appointment

                                    'notify_action_from' => $user,

                                    'notify_action_to' => $appointment->user_id,//who sent the request

                                    'notify_message' => " has been declined your appointment request.",

                                    'notify_status' => 2,

                                    'created_at' => Carbon::now(),

                                    'updated_at' => Carbon::now()

                                ];  //making notification row

                }

            }

            //-----------------------------------------------------mail-appointment accepted

            $toMail = $appointment->email;

            Mail::send('emails.provider_accepted_app', ['appInfo' =>$appointment],function ($m) use ($toMail){

                            $m->from('Info@linkaesthetics.com', 'LinkAesthetics');



                            $m->to($toMail)->subject('Appointment accepted');

                        }); 

            //-------------------------------------------------------------------------             

        }

        else if($status = 3)

        {

            $actiondone = 'declined';

            $declined_by = $user;

            $admin_status_text="Your Appointment has been declined,Thank you";

        }

        //------------------------------------------------------------------------

        $data[] = [

                    'notify_action_id' => $app_id,

                    'notify_action_type' => 1,//user-provider appointment

                    'notify_action_from' => $user,

                    'notify_action_to' => $appointment->user_id,//who sent the request

                    'notify_message' => " has been ".$actiondone." your appointment request.",

                    'notify_status' => 2,

                    'created_at' => Carbon::now(),

                    'updated_at' => Carbon::now()

                    ];//notification for current request

        //--------------------------------------------------------insert/update tables



        $updateappointment = BookAppointment::where('id',$app_id)

                      ->update(['appointment_status' => $status,'declined_by' => $declined_by]);//current request



        //----------------------------------------------------------decline



         $declineapp = BookAppointment::whereIn('id',$declineIds)

            ->update(['appointment_status' => 3,'declined_by' => $user]);//decline with decline ids



        //--------------------------------------------------------------------------



        // $notify = Notifications::where('id',$noti_id)

        //               ->update(['notify_status' => 1]);//change notification status to viewed



         Notifications::insert($data);//bulk insert to notification table             

        //-------------------------------------------------------------------------

        if((Auth::user()->user_type == 'prescriber' ) && $appointment->appointment_type == 2)

        {

            return redirect()->back()->with('success', 'success|Appointment status updated successfully');           

        }



        // $this->statusService->sendAppointmentMail($app_id,$admin_status_text,'Your Appointment!',$actiondone);



        return redirect()->back()->with('success', 'success|Appointment status updated successfully');          

	}



    /**

     * @param Request $request

     * @param $noty_id

     * @return \Illuminate\Http\JsonResponse

     */

    public function remove_notification(Request $request, $noty_id)

	{

		

		$userId = Auth::user()->id; 



        $count = Notifications::where('notify_action_to', $userId)

                                ->where('id',$noty_id)->count();

        if($count == 1) //check whether the user has rights to remove the data

        {

            Notifications::where('id', $noty_id)->delete();

        }else

        {

            return response()->json(array("status"=>"false","message"=>"Not an authorized user/invalid input"));

        }



		return response()->json(array("status"=>"true","message"=>"Notification removed"));

	}



    /**

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function appointments(){

		$provider=Auth::user()->id;



		

		$appointments=BookAppointment::leftJoin('user_details','appointment.user_id','=','user_details.user_id')

			->leftJoin('services','appointment.service_needed','=','services.services_id')

            ->leftJoin('services as cat','services.category','=','cat.services_id')

			->select('user_details.*','appointment.*','services.service','cat.service as service_name')

			->where('appointment.provider_id','=',$provider)

			// ->where('appointment.appointment_status','!=',1)

			// ->where('appointment.appointment_type','=',1)

            ->orderBy('appointment.id','DESC')

			->get();

			$statusArray = array('1'=>'Request','2'=>'Accepted','3'=>'Declined','4'=>'Cancelled by requester','5'=>'Cancelled by Prescriber',"6" => "Cancelled due to no payment within the time period");

            $payment_statusArray = array("1" => "Paid","2"=>"Not Paid");	

			return view('provider.appointment_history',compact('appointments','statusArray','payment_statusArray'));

			

	}



    /**

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function services_settings()

	{

		 $ServicesSettings = ServicesSettings::where('user_id', Auth::user()->id)->first();



		 $days = array();



		 if(!empty($ServicesSettings))

		 {

		 	$days = json_decode($ServicesSettings->available_days,true);

		 }



		 //-------------------------------------------------------------

          $locationPreference = array("1" => "Provider location","2" => "Mobile","3" => "Flexible");

         //------------------------------------------------------------



         return view('provider.services_settings',compact('ServicesSettings','days','locationPreference'));

	}



    /**

     * @param ServicesSettingsRequest $request

     * @return \Illuminate\Http\RedirectResponse

     */

    public function save_services_settings(ServicesSettingsRequest $request)

	{

		

		$servicesSettings = ServicesSettings::firstOrNew(array('user_id' => Auth::user()->id));

		$servicesSettings->user_id = Auth::user()->id;

		$servicesSettings->time_from = $request->input('time_from');

		$servicesSettings->time_to = $request->input('time_to');

		$servicesSettings->available_days = json_encode($request->input('available_days'));

        $servicesSettings->service_location_preference = $request->input('service_location_preference');



		$servicesSettings->save();

		

		return redirect('provider/services')->with('success','success|Services settings has been updated successfully');

	}



    /**

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function feedback(){

        $provider=Auth::user()->id;

        $feedback = Feedback::join('users' ,'users.id' ,'=' ,'feedback.user_id')

            ->select('feedback.*','users.name','users.photo')

            ->where('provider_id',$provider)

            ->orderBy('created_at','DESC')

            ->limit(6)

            ->get()->toarray();

        return view('provider.feedback',compact('feedback'));

    }
    /**
     * @param Requestss $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loadFeedback(Requestss $request){

        $provider = Auth::user()->id;
        $id = $request->id;
        $feedback = Feedback::join('users' ,'users.id' ,'=' ,'feedback.user_id' )
            ->select('feedback.created_at','feedback.feedback','users.name','users.photo','feedback.id as fb_id')
            ->where( 'feedback.id', '<', $id )
            ->where('feedback.status', '=' ,'2' )
            ->where('provider_id' ,'=', $provider )
            ->orderBy('feedback.created_at','DESC')
            ->limit(6)
            ->get()->toarray();

        return view('provider.load_more',compact('feedback'));
    }

    public function instant_appointment(Request $request)

    {

        $userData = Auth::user();


        $data = $_POST;

        $status = (isset($data['instant_appointment']) && $data['instant_appointment'] == 'on') ? 1 : 2;



        $update = ServicesSettings::where('user_id',$userData->id)

                        ->update(['instant_appointment' => $status]);





        if($update)

        {

            

            return redirect()->back()->with('success','success|Your setting has been updated successfully');

        }



        return redirect()->back()->with('success','danger|Something terminated your request, please try again later');


    }

    public function payment_history()

    {

        $userData = Auth::user();

        $payment_history = PaymentHistory::leftJoin('users as u1','payment_history.user_id','=','u1.id')

                                        ->leftJoin('users as u2','payment_history.paid_to','=','u2.id')

                                        ->select('u1.name as from','u2.name as to','payment_history.amount','payment_history.payment_date','payment_history.payment_status','payment_history.payment_type')

                                        ->where('user_id',$userData->id)

                                        ->orWhere('paid_to',$userData->id)

                                        ->get();                                                      



        $statusArray = array("1" => "Paid","2" => "Failed/not transfered");

        $typeArray = array("1" => "Appointment transfer","2" => "Advertisement" ,"3" => "Refund");                                                      

        return view('provider.payment_history',compact('payment_history','statusArray','typeArray'));                                   

    }



    public function image_crop(Requestss $request){



        $data = $request->image;

        $cropp_type = $request->cropp_type;



        $provider = Auth::user()->id;

        list( $type, $data ) = explode( ';', $data );

        list( , $data ) = explode( ',', $data );

        $data = base64_decode( $data );

        $image_name = time() . '.png';

        $gallery_id = "";

        if($cropp_type == 'banner') {

            file_put_contents( public_path( 'uploads/ad_banner/' . $image_name ), $data );

        }
        elseif ($cropp_type == 'profile'){



            file_put_contents( public_path( 'uploads/profile_photos/' . $image_name ), $data );

            User::where( 'id', $provider )->update( [ 'photo' => $image_name ] );

        }
        elseif ($cropp_type == 'gallery'){
            if($request->gallery_id){
                file_put_contents( public_path( 'uploads/gallery/' . $image_name ), $data );
                ProviderGallery::where('id','=',$request->gallery_id)->update(['file_name' => $image_name, 'extension' => '.png' ] );

            }else {

                file_put_contents( public_path( 'uploads/gallery/' . $image_name ), $data );
                $galleryarray = ProviderGallery::create( [ 'user_id' => $provider,'file_name' => $image_name,'extension' => '.png' ,'status' => '1'] );
                $gallery_id = $galleryarray->id;
            }
        }


        return response()->json(['image' => $image_name ,'gallery_id' =>  $gallery_id ]);

    }

    

    public function check_service_offer(Request $request)

    {

        $user = Auth::user();



        $data = Request::all();



        $offerCount = ProviderServices::where('services_id',$data['service'])->where('user_id',$user->id)->where('service_offer',1)->count();



        if($offerCount > 0)

        {

            $return = false;

            return response()->json($return);

        }

        else

        {

            $return = true;

            return response()->json($return);

        }

    } 

}


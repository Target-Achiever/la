<?php



namespace App\Http\Controllers\Prescriber;



use App\Http\Controllers\Controller;



use Illuminate\Http\Request;



use Auth;



use DB;



use App\Http\Requests;



use App\ServicesSettings;



use App\BookAppointment;



use App\ProviderServices;



use App\Notifications;



use App\Http\Requests\BookPrescriptionServiceRequest;



use App\User;



use App\User_detail;



use Carbon\Carbon;



class PrescriptionServicesController extends Controller

{

    //

    public function index()

    {

        if((Auth::user()->user_type == 'non_prescriber' ))
        {
           $userinfo = User_detail::leftJoin('services_settings','user_details.user_id','=','services_settings.user_id')
           ->select('user_details.latitude','user_details.longitude','services_settings.prescription_enable')
           ->where('user_details.user_id',Auth::user()->id)->first();

           $apphistory = BookAppointment::leftJoin('services','appointment.service_needed','=','services.services_id')
                      ->leftJoin('services as cat','services.category','=','cat.services_id')
                      ->leftJoin('users','appointment.provider_id','=','users.id')
                      ->select('appointment.*','services.service','users.name','cat.service as categoryname')
                      ->where('appointment.user_id','=',Auth::user()->id)
                      ->where('appointment.appointment_type','=',2)
                      ->orderBy('id','desc')
                      ->get(); 

             $current = Carbon::now();         
             foreach ($apphistory as $key => $value) 
             {
                $value['payment_url'] = \Crypt::encrypt('appointment-'.$value->id);
                $value['paybutton'] = ($current->lt(Carbon::parse($value->preferred_date.''.$value->appointment_time_from)->subHour()) && $value->payment_status == 2) ? "true" : "false";
                $value['cancel_url'] = \Crypt::encrypt('appointment-'.$value->id);
                $value['cancel_button'] = ($value->appointment_status != 3 && $value->appointment_status != 4 && $value->appointment_status != 5) ? true : false;
             }      

            $status_array = array('1'=>'Request','2'=>'Accepted','3'=>'Declined','4'=>'Cancelled by requester','5'=>'Cancelled by Prescriber','6' => 'Auto cancel due to no payment');
            //------------------------------------------------------nearest providers
            $distance = number_format(20 * 0.621371,2,'.','');//5 km distance

            $prescribers = DB::select( DB::raw("SELECT users.id, users.name,user_details.country,users.photo, 3956 * 2 * ASIN(SQRT( POWER(SIN(($userinfo->latitude - latitude) * pi()/180 / 2), 2) + COS($userinfo->latitude * pi()/180) * COS(latitude * pi()/180) *POWER(SIN(($userinfo->longitude - longitude) * pi()/180 / 2), 2) )) as distance FROM user_details LEFT JOIN users ON(user_details.user_id = users.id) WHERE users.user_type='prescriber' HAVING distance <= $distance") );
            //-----------------------------------------------------------------------   
           return view('provider.prescription_services_nonprescriber',compact('apphistory','prescribers','status_array'));
        }
        else if((Auth::user()->user_type == 'prescriber' ))
        {
            $prescription_request = array();
            $user = Auth::user()->id;

            $servicesSettings = ServicesSettings::where('user_id',Auth::user()->id)->first();

            $apphistory = BookAppointment::leftJoin('services','appointment.service_needed','=','services.services_id')
                      ->leftJoin('services as cat','services.category','=','cat.services_id')
                      ->leftJoin('users','appointment.user_id','=','users.id')
                      ->select('appointment.*','services.service','users.name','cat.service as categoryname')
                      ->where('appointment.provider_id','=', $user)
                      ->where('appointment.appointment_type','=',2)
                      ->orderBy('id','desc')
                      ->get();

            foreach ($apphistory as $key => $value) 
             {
    
                $value['cancel_url'] = \Crypt::encrypt('appointment-'.$value->id);
                $value['cancel_button'] = ($value->appointment_status != 3 && $value->appointment_status != 4 && $value->appointment_status != 5 && $value->appointment_status == 2) ? true : false;
             }             

            $status_array = array('1'=>'Request','2'=>'Accepted','3'=>'Declined','4'=>'Cancelled by requester','5'=>'Cancelled by Prescriber','6' => 'Auto cancel due to no payment');
            //-------------------------------------------------------------------------------------          
                     

            $prescription_request = BookAppointment::leftJoin('services','appointment.service_needed','=','services.services_id')
                      ->leftJoin('users','appointment.user_id','=','users.id')
                      ->leftJoin('services as cat','services.category','=','cat.services_id')
                      ->select('appointment.*','services.service','users.name','cat.service as categoryname','services.service_type')
                      ->where('provider_id','=', $user)
                      ->where('appointment.appointment_status','=', 1)
                      ->where('appointment.appointment_type','=', 2)->get();
            
             foreach ($prescription_request as $key => $value) 
             {
                
                $value['cancel_url'] = \Crypt::encrypt('appointment-'.$value->id);
                $value['cancel_button'] = ($value->appointment_status != 3 && $value->appointment_status != 4 && $value->appointment_status != 5) ? true : false;
             } 
            //-------------------------------------------------------------------------        

            return view('provider.prescription_services_prescriber',compact('apphistory','prescription_request','servicesSettings','status_array')); 
        }          


    }

    public function set_service_availability(Request $Request,$set,$user)

    {

            // echo $user."***".$set;die;

    	// $set = ($set == 'on') ? 1 : 2; 

    	

    	echo $update = ServicesSettings::where('user_id' , $user)

    				->update(['prescription_enable' => $set]);die;

    				

    	if($update)

    	{

    		echo true;

    	}else

    	{

    		echo false;

    	}

    	

    }

    public function prescription_request(Request $request,$provider)

    {

    	//---------------------------------------------
        $provider_info = User::join('user_details', 'users.id', '=', 'user_details.user_id')
            
            ->leftJoin('provider_services', 'provider_services.user_id', '=', 'users.id')
            ->leftJoin('services_settings', 'users.id', '=', 'services_settings.user_id')
            ->leftJoin('services', 'provider_services.services_id', '=', 'services.services_id')
            ->leftJoin('services as cat','provider_services.category', '=', 'cat.services_id')
            ->select('users.id as provider_id','users.name','users.photo','user_details.forename','user_details.nationality','user_details.latitude','user_details.longitude','user_details.address_line_1','provider_services.user_id','provider_services.service_amount','provider_services.prescription_amount','provider_services.quantity','provider_services.service_type','services.services_id','services.service','services_settings.time_from','services_settings.time_to','services_settings.available_days','cat.service as categoryname')
            ->where('services.service','!=','')
            ->where('provider_services.prescription_amount','!=','')
            ->where('users.id','=',$provider)->get()->toArray();



            $providerData= array();
            
            foreach ($provider_info as $key => $value) {
                
                if(!isset($providerData[$value['user_id']]))
                {
             
                    $amount = $value['service_amount'];
                    $preamount = $value['prescription_amount'];
                    $service_id = $value['services_id'];
                    $service  = $value['service'];
                    $quantity = $value['quantity'];
                    $service_type = $value['service_type'];


                    unset($value['service'],$value['services_id'],$value['service_amount'],$value['quantity'],$value['service_type'],$value['prescription_amount']);
                    if(!empty($service_id))
                    {
                        
                        $providerData['providerInfo'] = $value;
                        $indexkey = ($value['categoryname'] != '' ) ? $value['categoryname'] : 'Deals';
                        $providerData['provider_services'][$indexkey][] = array("amount" => $amount,'pre_amount' => $preamount,"service_id"=>$service_id,"service"=>$service,'volume'=> $quantity,'type'=>$service_type);

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
            $services = (isset($providerData['providerInfo'])) ? $providerData['providerInfo'] : array();
            unset($providerData['providerInfo']);
            $providerData = array_merge($providerData,$services);   
            
            return view('provider.prescription_request',compact('providerData'));

    }

    public function book_prescription_service(BookPrescriptionServiceRequest $request)

    {

        // $data = $request->input();



        // $create = BookAppointment::create($request->all());

        $serviceTime = ProviderServices::where('user_id','=',$request->input('provider_id'))

                        ->where('services_id','=',$request->input('service_needed'))

                        ->select('provider_services.time_needed','provider_services.prescription_amount')->first();





                        // print_r($serviceTime);die;

        // $addTime = strtotime("+$serviceTime->time_needed hours", strtotime($request->input('appointment_time_from')));

        // $totime = date('G:i', $addTime);

        $create = BookAppointment::create([

                                    'user_id' => $request->input('user_id'),

                                    'provider_id' => $request->input('provider_id'),

                                    'service_needed' => $request->input('service_needed'),

                                    'service_amount' => $serviceTime->prescription_amount,

                                    'preferred_date' => $request->input('preferred_date'),

                                    'appointment_time_from' => $request->input('appointment_time_from'),

                                    'appointment_time_to' => $request->input('appointment_time_from'),

                                    'appointment_type' => 2

                                ]);

        if($create)

        {



            Notifications::create([

                                    'notify_action_id' => $create->id,

                                    'notify_action_type' => 1,//non-prescriber-prescriber appointment

                                    'notify_action_from' => $create->user_id,

                                    'notify_action_to' => $create->provider_id,

                                    'notify_message' => "has sent you an prescription request.",

                                    'notify_status' => 2

                                ]);

            return redirect('/provider/prescription-services')->with('success','success|Your appointment request has been sent successfully');

        }

    }



}


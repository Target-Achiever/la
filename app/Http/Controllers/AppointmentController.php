<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;



use App\Http\Requests;



use App\Http\Requests\AppointmentRequest;



use App\BookAppointment;



use App\ProviderServices;



use App\User;



use App\Notifications;



use DateTime;



use App\ServicesSettings;



use Carbon\Carbon;



use App\Disclaimer;





class AppointmentController extends Controller

{

    //

    /**

     * @param Request $request

     * @param $id

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function book_an_appointment(Request $request, $id)

    {



        $provider_info = User::join('user_details', 'users.id', '=', 'user_details.user_id')

            ->leftJoin('user_answers','users.id','=','user_answers.user_id')

            ->leftJoin('provider_services', 'provider_services.user_id', '=', 'users.id')

            ->leftJoin('services_settings', 'users.id', '=', 'services_settings.user_id')

            ->leftJoin('services', 'provider_services.services_id', '=', 'services.services_id')

            ->leftJoin('services as cat','provider_services.category', '=', 'cat.services_id')

            ->select('users.user_slug','users.name','users.photo','user_details.forename','user_details.nationality','user_details.latitude','user_details.longitude','user_details.address_line_1','user_details.address_line_2','provider_services.user_id','provider_services.service_amount','provider_services.quantity','services.services_id','services.service','services_settings.time_from','services_settings.time_to','services_settings.available_days','service_location_preference','user_answers.registered_with','cat.service as categoryname','provider_services.service_type')

            ->where('services.service','!=','')

            ->where('provider_services.service_amount','!=','')

            ->where('users.user_slug','=',$id)->get()->toArray();



            $providerData= array();



            $disclaimer = Disclaimer::where('type','=','1')->orderBy('updated_at','desc')->first();

            $providerData['disclaimer'] =$disclaimer['disclaimer'];



            foreach ($provider_info as $key => $value) {



                if(!isset($providerData[$value['user_id']]))

                {

                    // echo $key;

                    // echo "<br>";

                    $amount = $value['service_amount'];

                    $service_id = $value['services_id'];

                    $service  = $value['service'];

                    $quantity = $value['quantity'];

                    $service_type = $value['service_type'];



                    unset($value['service'],$value['services_id'],$value['service_amount'],$value['quantity'],$value['service_type']);

                    if(!empty($service_id))

                    {



                        $providerData['providerInfo'] = $value;

                        $indexkey = ($value['categoryname'] != '' ) ? $value['categoryname'] : 'Deals';

                        $providerData['provider_services'][$indexkey][] = array("amount" => $amount,"service_id"=>$service_id,"service"=>$service,'volume'=> $quantity,'type'=>$service_type);



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



            $locationPreference = array("1" => "Provider location","2" => "Mobile","3" => "Flexible");

            //------------------------------------------------------

            return view('book_an_appointment',compact('providerData','locationPreference'));

    }





    /**

     * @param AppointmentRequest $request

     * @return \Illuminate\Http\RedirectResponse

     */

    public function book_service(AppointmentRequest $request)

    {



        // $create = BookAppointment::create($request->all());

        $serviceTime = ProviderServices::where('user_id','=',$request->input('provider_id'))

                        ->where('services_id','=',$request->input('service_needed'))

                        ->select('provider_services.time_needed','provider_services.service_amount','provider_services.quantity','provider_services.time_needed')->first();



        $service_settings = ServicesSettings::where('user_id',$request->input('provider_id'))->first();



        $appStatus = ($service_settings->instant_appointment == '1') ? '2' : '1';//if provider instant appointment is enabled set appointment status = 2 fop  appointment accepted



        $addTime = strtotime("+$serviceTime->time_needed hours", strtotime($request->input('appointment_time_from')));

        $totime = date('G:i', $addTime);

        $create = BookAppointment::create([

                                    'user_id' => $request->input('user_id'),

                                    'provider_id' => $request->input('provider_id'),

                                    'service_needed' => $request->input('service_needed'),

                                    'service_amount' => $serviceTime->service_amount,

                                    'quantity'  => $serviceTime->quantity,

                                    'time_needed'  => $serviceTime->time_needed,

                                    'user_name' => $request->input('user_name'),

                                    'user_contact' => $request->input('user_contact'),

                                    // 'user_email' => $request->input('user_email'),

                                    'preferred_date' => $request->input('preferred_date'),

                                    'appointment_time_from' => $request->input('appointment_time_from'),

                                    'appointment_time_to' => $totime,

                                    'appointment_status' => $appStatus

                                ]);

        if($create){

            $data[] = [

                                    'notify_action_id' => $create->id,

                                    'notify_action_type' => 1,//user-provider appointment

                                    'notify_action_from' => $create->user_id,

                                    'notify_action_to' => $create->provider_id,

                                    'notify_message' => "has sent you an appointment request.",

                                    'notify_status' => 2,

                                    'created_at' => Carbon::now(),

                                    'updated_at' => Carbon::now()

                                ];  //making notification row
            if($appStatus == '2')
            {

            $data[] = [

                                    'notify_action_id' => $create->id,

                                    'notify_action_type' => 1,//user-provider appointment

                                    'notify_action_from' => $create->provider_id,

                                    'notify_action_to' => $create->user_id,

                                    'notify_message' => "has been accepted your appointment request.",

                                    'notify_status' => 2,

                                    'created_at' => Carbon::now(),

                                    'updated_at' => Carbon::now()

                                ];  //making notification row        

            }                    
            Notifications::insert($data);//bulk insert to notification table

            return redirect('/home')

                ->with('success','success|Your appointment request has been sent successfully');

        }

    }



    /**

     * @param Request $request

     * @param $date

     * @param $service

     * @param $provider

     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View

     */

    public function get_available_time_slots(Request $request, $date, $service, $provider)

    {



        $apps = BookAppointment::where('provider_id','=',$provider)

                         ->where('preferred_date','=',$date)

                         ->where('appointment_status','=',2)

                         // ->where('appointment_type', '=', 1)

                         ->where('preferred_date', '>=', date('Y-m-d'))

                         ->select('appointment.appointment_time_from','appointment.appointment_time_to')->get()->toArray();





        //----------------------------------------------------

        $serviceSettings = ServicesSettings::leftJoin('provider_services','services_settings.user_id','=','provider_services.user_id')

                                ->where('services_settings.user_id','=',$provider)

                                ->where('provider_services.services_id','=',$service)

                                ->select('services_settings.time_from','services_settings.time_to','services_settings.available_days','provider_services.time_needed')->first();





            if($serviceSettings == '')

            {

                $serviceSettings = 'This user has not yet set their service time';

                return view('provider.available_time_slots',compact('serviceSettings'));//provider not yet set any service settings

                exit;



            }



            //------------------------------------------check selected day is available for the provider

            $daysavailable = json_decode($serviceSettings->available_days,true);



            $day = strtolower(Carbon::parse($date)->format('l'));



            $days = array("1" => "monday","2" => "tuesday","3" => "wednesday","4" => "thursday","5" => "friday","6" => "saturday","7" => "sunday");



            $key = array_search($day, $days);



            if(!in_array($key,$daysavailable))

            {

                $serviceSettings = 'Provider is not available for this day of week.';

                return view('provider.available_time_slots',compact('serviceSettings'));//provider is not available for this day

                exit;

            }

            //-------------------------------------------------------------------------------------



            $serviceStart = $selectedTime = $serviceSettings->time_from;

            $servicetimefrom  = (int)$serviceSettings->time_from;

            $servicetimeto = (int)$serviceSettings->time_to;

            $timeforservice = $serviceSettings->time_needed;;

            //-------------------------------------------------

            for($i = $servicetimefrom; $i <= $servicetimeto - $timeforservice ; $i = $i + 0.50)

            {

                        $slots[$serviceStart] = $serviceStart;

                        $selectTime = $serviceStart;

                        $cu = strtotime("+30 minutes", strtotime($selectTime));

                        $serviceStart = date('G:i', $cu);

            }



            //-------------------------------------------------------

            // $bookedTimes = array(array("9:30","12:30"),array("15:00","17:00"),array("17:30","19:00"));

            foreach ($apps as $key => $value)

            {



                // echo "-----------------------------------------";

                for($i = $servicetimefrom; $i <= $servicetimeto - $timeforservice ; $i = $i + 0.50)

                {



                        $available_time = $selectedTime;



                        $endTime = strtotime("+$timeforservice hours", strtotime($selectedTime));//check whether the time with added service time would come inside the booked time

                        $timegap = date('G:i', $endTime);



                        //-------------------------------------------------convert the time to 24hrs format

                        $checkT = DateTime::createFromFormat('H:i', $timegap);

                        $bookedFromD = DateTime::createFromFormat('H:i', $value['appointment_time_from']);

                        $bookedToD = DateTime::createFromFormat('H:i', $value['appointment_time_to']);



                        //----------------------------------------------------conditions

                        $formatailable_time = DateTime::createFromFormat('H:i', $available_time);



                        if ($checkT >= $bookedFromD && $checkT <= $bookedToD)//check whether the time comes under the booked time schedule

                        {

                           unset($slots[$available_time]);

                        }

                        else if (($bookedFromD >= $formatailable_time && $bookedFromD <= $bookedToD) && ($bookedToD >= $formatailable_time && $bookedToD <= $checkT))//check if the reserved time placing in between the added times, ex: 10:00(fromtime) - 13:00(totime) will place 9:30 to :13:30 if the next service time is 4hrs..and the time 9:30 would be avail. to avoid this, checking this condition.

                        {



                            unset($slots[$available_time]);

                        }

                        $availT = DateTime::createFromFormat('H:i', $available_time);

                        if ($availT >= $bookedFromD && $availT <= $bookedToD)//check whether the actual(without service time) time comes under the booked time schedule

                        {

                            unset($slots[$available_time]);

                        }

                        //===============================================================



                        $endTime = strtotime("+30 minutes", strtotime($selectedTime));

                        $selectedTime = date('G:i', $endTime);



                        $available_time = strtotime("+30 minutes", strtotime($selectedTime));

                        $available_time = date('G:i', $available_time);



                }



                        // $selectedTime = "7:00";

                        $selectedTime = $serviceSettings->time_from;

            }





        //------------------------------------------------------------end

        return view('provider.available_time_slots',compact('slots'));

    }



}


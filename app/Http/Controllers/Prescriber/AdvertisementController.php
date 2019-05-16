<?php



namespace App\Http\Controllers\Prescriber;



use Carbon\Carbon;



use DateInterval;



use DatePeriod;



use DateTime;



use Illuminate\Http\Request;



use App\Http\Requests;



use App\Http\Controllers\Controller;



use App\Advertisement;



use App\Services;



use Auth;



use App\AdvertisementType;



use App\AdvertisementAmount;



use App\ProviderServices;



use App\Http\Controllers\Prescriber\AdPaymentController;



use Config;

use DB;

class AdvertisementController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {



        $user_id=Auth::user()->id;

        // $advertisement=Advertisement::join('services','services.services_id','=','advertisement.service')

        //     ->where('user_id',$user_id)

        //     ->where('advertisement.ad_status','1')

        //     ->orwhere('advertisement.ad_status','2')

        //     ->get();



        $advertisement=Advertisement::where('user_id',$user_id)

            ->where('advertisement.ad_status','1')

            ->orwhere('advertisement.ad_status','2')

            ->get();



        $statusArray = array("1" => "Success","2" => "Failed");



        return view('provider.advertisement',compact('advertisement','statusArray'));

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $user = Auth::user();
        $service_array = $service_array = array();

        // $services = Services::all();
        $services = ProviderServices::leftJoin('services','provider_services.services_id','=','services.services_id')
        ->leftJoin('services as cat','provider_services.category','=','cat.services_id')
        ->select('provider_services.services_id','provider_services.category','services.service','cat.service as service_name','services.service_type')
        ->where('provider_services.user_id',$user->id)
        ->where('services.service','!=','')
        ->where('provider_services.service_status',1)->get();

        
        $ad_types= AdvertisementType::orderBy('updated_at','DESC')->first();
        $status = array("1"=>"Active","2"=>"Pending","3"=>"Removed","4"=>"Deactivated by admin");
        $service_status = '1';
        //------------------------------------
        $ad_amount =  AdvertisementAmount::select('ad_amount')->first();

        if($services != null)
        {
            foreach($services  as $ser)
            {

                $key = $ser->service_name; 
                if($ser->service_type == '2')
                {
                    $key = 'Combination deals';
                }
                if(!isset($service_array[$key]))
                {
                    $service_array[$key] = array($ser->services_id => $ser->service);
                }else
                {
                    $service_array[$key][$ser->services_id] = $ser->service;
                }

                
            }
        }

        return view('provider.create_edit_advertisement',compact('status','service_status',
            'service_array','ad_types','ad_amount'));

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        //=======================================================validation

        $this->validate($request,[

            'ad_header'=>'required',

            'ad_offer' => 'numeric',

            'service' => 'required',

            'ad_description'=>'required',

            'period_from'=>'required',

            'ad_banner'=>'required',

        ]);

        //================================================================

        $ad_type = AdvertisementType::select('ad_days','ad_weeks')->orderBy('created_at','desc')->first();
        $addType = "";
        if($ad_type->ad_days=='1'){  $addType = '2';  }elseif($ad_type->ad_weeks=='1'){ $addType = '1'; }
        $ad_amount =  AdvertisementAmount::select('ad_amount')->where('ad_type',$addType)->orderBy('id','desc')->first();//ad amount created by admin


        $user_id = Auth::user()->id;

        $inputs = $request->all();



        if(isset($inputs['declaration'])){

            $data['user_id'] = $user_id;

            $data['service'] = $inputs['service'];

            $data['ad_header'] = $inputs['ad_header'];

            $data['ad_description'] = $inputs['ad_description'];

            $data['period_from'] = date("Y-m-d",strtotime(str_replace('/', '-', $inputs['period_from'])));

            //$data['ad_status'] = '2';

            $data['ad_banner'] = $inputs['ad_banner_text'];



            if($request->days_slots){

                $data['time_slot']="";

                $data['days_slots'] = $inputs['days_slots'];

                for($i=0; $i<=6; $i++ ){

                    if($i==$data['days_slots']) {

                        $data['period_to'] = Carbon::parse( $data['period_from'] )->addDays( $i )->subDays(1);

                    }

                }
                $data['amount'] = $ad_amount->ad_amount * (int)$data['days_slots'];
            }

            if( $request->time_slot){

                $data['days_slots']="";

                $data['time_slot'] = $inputs['time_slot'];

                switch ($data['time_slot']){

                    case "1":

                        $data['period_to'] =Carbon::parse($data['period_from'])->addWeek(1)->subDays(1);

                        $data['amount'] = $ad_amount->ad_amount * (int)$data['time_slot'];

                        break;

                    case "2":

                        $data['period_to'] =Carbon::parse($data['period_from'])->addWeek(2)->subDays(1);

                        $data['amount'] = $ad_amount->ad_amount * (int)$data['time_slot'];

                        break;

                    case "3":

                        $data['period_to'] = Carbon::parse($data['period_from'])->addWeek(3)->subDays(1);

                        $data['amount'] = $ad_amount->ad_amount * (int)$data['time_slot'];

                        break;

                    default:

                        $data['period_to'] =Carbon::parse($data['period_from'])->addWeek(1)->subDays(1);

                }



            }



            /*if ($request->hasFile('ad_banner')) {



                $file = $request->file("ad_banner");

                $photo = $user_id."_".time().'.'.$file->getClientOriginalExtension();

                $data['ad_banner'] = $photo;

                $file->move(public_path('uploads/ad_banner'), $photo);

            }*/



        }



        if(isset($inputs['ad_offer']) && $inputs['ad_offer'] == 1)

        {

            //-----------------------------------

            $pro_service = ProviderServices::where('services_id',$inputs['service'])->where('user_id',$user_id)->first();



            $offeramount = (int)$pro_service->service_actual_amount - ((int)$inputs['ad_offer_percentage'] / 100) * (int)$pro_service->service_actual_amount;





            ProviderServices::where('services_id',$inputs['service'])

            ->update(['service_amount' => $offeramount,'service_offer' => 1,'offer_percentage' => $inputs['ad_offer_percentage']]);



            //-------------------------------------------

            $data['ad_offer'] = 1;

            $data['ad_offer_percentage'] = $inputs['ad_offer_percentage'];



        }



        $createAd = Advertisement::create($data);



        $message = AdPaymentController::advertisement_payment($request,$createAd->id);



        return redirect('provider/advertisement')

            ->with('success',$message);



    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        //

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        $service_array = array();

        $user_id = Auth::user()->id;

        // $services = Services::all();

        $services = ProviderServices::leftJoin('services','provider_services.services_id','=','services.services_id')

        ->leftJoin('services as cat','provider_services.category','=','cat.services_id')

        ->select('provider_services.services_id','provider_services.category','services.service','cat.service as service_name','services.service_type')

        ->where('provider_services.user_id',$user_id)

        ->where('provider_services.service_status',1)->get();



        $status = array("1"=>"Active","2"=>"Pending","3"=>"Remove");

        $ad_types= AdvertisementType::orderBy('updated_at','DESC')->first();



        foreach($services as $value)

        {

            $service_array[$value->services_id] = $value->service;

        }



        if($services != null)

        {

            foreach($services  as $ser)

                {



                    $key = $ser->service_name;

                    if($ser->service_type == '2')

                    {

                        $key = 'Combination deals';

                    }

                    if(!isset($service_array[$key]))

                    {

                        $service_array[$key] = array($ser->services_id => $ser->service);

                    }else

                    {

                        $service_array[$key][$ser->services_id] = $ser->service;

                    }





                }

        }



        $advertisement=Advertisement::find($id);



        return view('provider.create_edit_advertisement',compact('ad_types','item','service_array','status','advertisement'));

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {

        $this->validate($request, [

            'ad_header'=>'required',

            'ad_description'=>'required',
        ]);



        $user_id = Auth::user()->id;

        $inputs = $request->all();



        if(isset($inputs['declaration'])){

            $data['user_id'] = $user_id;

            //$data['time_slot'] = $inputs['time_slot'];

            $data['ad_header'] = $inputs['ad_header'];

            $data['ad_description'] = $inputs['ad_description'];

          //  $data['period_from'] = date("Y-m-d",strtotime(str_replace('/', '-', $inputs['period_from'])));

            $data['ad_status'] = '1';



            if ($request->hasFile('ad_banner')) {

                /*$file = $request->file("ad_banner");

               $photo = $user_id."_".time().'.'.$file->getClientOriginalExtension();*/

                $data['ad_banner'] = $inputs['ad_banner_text'];

                /*$file->move(public_path('uploads/ad_banner'), $photo);*/

            }else{

                $data['ad_banner'] = $inputs['banner_image'];

            }



          /*  switch ($inputs['time_slot']){



                case "One week":

                    $data['period_to'] =Carbon::parse($data['period_from'])->addWeek(1)->subDays(1);

                    break;

                case "Two weeks":

                    $data['period_to'] =Carbon::parse($data['period_from'])->addWeek(2)->subDays(1);

                    break;

                case "Three weeks":

                    $data['period_to'] = Carbon::parse($data['period_from'])->addWeek(3)->subDays(1);

                    break;

                default:

                    $data['period_to'] =Carbon::parse($data['period_from'])->addWeek(1)->subDays(1);

            }
*/




        }



        Advertisement::find($id)->update($data);



        return redirect('provider/advertisement')

            ->with('success','success|Advertisement updated successfully');

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        $user = Auth::user();

        $ad = Advertisement::where('id',$id)->where('user_id',$user->id)->first();

        Advertisement::find($id)

            ->update(['ad_status' => '3']);

        // $remoceoffer = ProviderServices::where('services_id',$ad->service)->where('user_id',$user->id)->update(['service_offer'=>2]);
        DB::update(DB::raw('update provider_services set service_amount=provider_services.service_actual_amount,offer_percentage="",service_offer="2" where user_id="'.$user->id.'" AND services_id="'.$ad->service.'"')); 



        return redirect('provider/advertisement')

            ->with('success','success|Advertisement removed successfully');

    }



    /**

     * @param Request $request

     * @internal param $preferred_date

     */

    public function search(Request $request){



        $startTime=Carbon::parse(date("Y-m-d",strtotime(str_replace('/', '-', $request->date))));

        switch ($request->time_slot){



            case "One week":

                $endTime = Carbon::parse($startTime)->addWeek(1)->subDays(1);

                break;

            case "Two weeks":

                $endTime = Carbon::parse($startTime)->addWeek(2)->subDays(1);

                break;

            case "Three weeks":

                $endTime = Carbon::parse($startTime)->addWeek(3)->subDays(1);

                break;

            default:

                $endTime = Carbon::parse($startTime)->addWeek(1)->subDays(1);

        }



        $advertisement=Advertisement::where('ad_payment_status','=','1')

            ->where('ad_status','=','1')

            ->orderby('period_from')->get();



        $request_date = $this->generateDateRange($startTime,$endTime);

        //print_r($request_date);

        $dates = [];

        foreach ($request_date as $req_date){



            foreach ($advertisement as $key => $adver) {



                $from = Carbon::parse( $adver['period_from'] );

                $to = Carbon::parse( $adver['period_to'] );

                $advertisement_dates = $this->generateDateRange( $from, $to );



                foreach ($advertisement_dates as $adver_date) {



                    if ( $adver_date == $req_date ) {

                        $dates[] =$adver_date;

                    }

                }

            }

        }



        $result_date=array_count_values($dates);

        $result_status="";

        $slots_limit=15;

        foreach ($result_date as $result){

            if($result >= $slots_limit){

                $result_status="Advertisement slots is not available.";

            }

        }

        return response()->json($result_status);

    }



    /**

     * @param Carbon $start_date

     * @param Carbon $end_date

     * @return array

     */

    private function generateDateRange(Carbon $start_date, Carbon $end_date)

    {

        $dates = [];



        for($date = $start_date; $date->lte($end_date); $date->addDay()) {



            $dates[] = $date->format('Y-m-d'). " 00:00:00";



        }



        return $dates;



    }

    public function advertisement_amount(Request $request)

    {

        $data = $request->all();

        $user = Auth::user();

        $ad_type = AdvertisementType::select('ad_days','ad_weeks')->orderBy('created_at','desc')->first();
        $addType = "";
        if($ad_type->ad_days=='1'){  $addType = '2';  }elseif($ad_type->ad_weeks=='1'){ $addType = '1'; }
        $ad_amount =  AdvertisementAmount::select('ad_amount')->where('ad_type',$addType)->orderBy('id','desc')->first();//ad amount created by admin

        
        if($ad_amount != null)
        {

            if($ad_type != null)
            {

                $amount = $ad_amount->ad_amount * (int)$data['duration'];
                
                // if($data['offer'] != '')
                // {

                //     $amount = $amount - ((int)$data['offer'] / 100) * $amount;
                // }
                

                return response()->json(array('status' => true ,"message" => conversion_to_pound($amount)));
            }
            else
            {
                return response()->json(array('status' => false ,"message" => "Advertisement type(days/weeks) has not yet set by Admin."));
            }
        }else
        {
            return response()->json(array('status' => false ,"message" => "Advertisement amount has not yet set by Admin."));
        }

    }

}


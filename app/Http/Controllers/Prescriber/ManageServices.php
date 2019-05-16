<?php

namespace App\Http\Controllers\Prescriber;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services;

use App\ProviderServices;

use Auth;

use Alert;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\CommonController;

use App\ServicesSettings;

class ManageServices extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $service_type = array('1' => 'Regular','2' => 'Combination deals','3' => 'Service material');
        $services = ProviderServices::join('services as material','provider_services.services_id', '='                            , 'material.services_id')
                                      ->leftJoin('services as cat','provider_services.category','=','cat.services_id')
                                      ->select('provider_services.*', 'material.service as materialName','provider_services.quantity','cat.service as category','material.service_type','material.combination')
                                      ->where('provider_services.user_id',Auth::user()->id)
                                      ->get();

        foreach ($services as $key => $value) 
        {
            if($value->service_type == 2)
            {

              $names  = Services::whereIn( 'services_id', explode(',',$value->combination))->lists( 'service' )->toArray();
              $services[$key]['category'] = 'Combination deals';
              $services[$key]['materialName'] = $value->materialName;

            }
        }                               
        
            
        return view('provider.manage_services',compact('services','service_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        //----------------------check whether the user updatd the service settings
        $service_settings = ServicesSettings::where('user_id',$user->id)->count();
        if($service_settings == '0')
        {
          return redirect('provider/services-settings')->with('success','warning|Please update the service settings.');
        }
        //-------------------

        $service_array = $procombos = array();

        $services = Services::where('service_type',1)
                                ->where('service_status',1)
                                ->get();
        $status = array("1"=>"Active","0"=>"In-active");
        $service_status = '1';

        foreach($services as $value)
        {
            $service_array[$value->services_id] = $value->service;
        }

        $combo_services_array = ProviderServices::leftJoin('services as material','provider_services.services_id','=','material.services_id')
        ->leftJoin('services as cat','provider_services.category','=','cat.services_id')
        ->select('material.service as service','cat.service as category_name','material.services_id','material.service_type')
        ->where('provider_services.user_id', $user->id)
        ->where('material.service','!=','')->get();

        

        if($combo_services_array != null)
        {
            
            foreach($combo_services_array  as $ser)
            {

                $index = $ser->category_name;
                if($ser->category_name == '')
                  $index = 'Combination deals';
               
                if(!isset($procombos[$index]))
                {

                    $procombos[$index] = array($ser->services_id => $ser->service);
                }else
                {
                    $procombos[$index][$ser->services_id] = $ser->service;
                }

                
            }
        }

        return view('provider.create_edit_service',compact('status','service_status','service_array','procombos','combo'));
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
            $required = ($request->input('service_type') == 1) ? 'required' : '';
            $comborequired = ($request->input('service_type') == 2) ? 'required' : '';
            $this->validate($request,[
             'services_id'=>'required',
             'service' => $required,//material required
             'quantity' => $required,
             'combo_service' => $comborequired,
             'service_amount'=>'required|numeric|min:100',
             'time_needed'=>'required|numeric',
             'service_status'=>'required',
          ]);
        //================================================================

        $user_id = Auth::user()->id;
        $data = $request->all();

         if($data['service_type'] == 1)
         {

              $serviceCount = ProviderServices::leftJoin('services','provider_services.services_id','=','services.services_id')
                ->where('provider_services.user_id',$user_id) 
                ->where('provider_services.category',$data['services_id'])
                ->where('provider_services.quantity',$data['quantity'])
                ->where('service',$data['service']);
          }else
          {
              $serviceCount = ProviderServices::leftJoin('services','provider_services.services_id','=','services.services_id')
              ->where('provider_services.user_id',$user_id)
              ->where('services.combination',strtolower(str_replace(' ', '',$data['combo_service'])));
          }

        $serviceCount =  $serviceCount->count(); 
         
        if($serviceCount == 0)
        {               
            //------------------create material for particular service
            $creatematerial = Services::create( [ 'user_id' => $user_id,'service' => ($data['service_type'] == 1) ? $data['service'] : $data['combo_service'], 'category' => ($data['service_type'] == 1) ? $data['services_id'] : '','service_type' => ($data['service_type'] == 1) ? 3 : 2,'service_status' => 1 ,'combination' => ($data['service_type'] == 2) ? strtolower(str_replace(' ', '', $data['combo_service'])) : ''] );
            //---------------------------------------------------------end  


            $pservice = new ProviderServices();
            $pservice->user_id = $user_id;
            $pservice->services_id = $creatematerial->id;//category id- relation services_id -service table
            if($data['service_type'] == 1)
            {

              $pservice->category = $data['services_id'];
              $pservice->quantity = $data['quantity'];
            }
            $pservice->service_amount = conversion_to_cent($data['service_amount']);
            $pservice->service_actual_amount = conversion_to_cent($data['service_amount']);
            // $pservice->prescription_amount = (isset($data['prescription_amount'])) ? conversion_to_cent($data['prescription_amount']) : '';

            $pservice->time_needed = $data['time_needed'];
            $pservice->service_status = $data['service_status'];
            $pservice->service_type = ($data['service_type'] == 1) ? 1 : 2;  
            $pservice->save(); 


            $status = 'success'; 
            $message = 'success|You are successfully added a service.';
        }
        else
        {
            $status = 'success'; 
            $message = 'success|You have already created the chosen service';
        }
       
        return redirect('provider/services')->with($status,$message);

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
        //
        $user = Auth::user();

        //----------------------check whether the user updatd the service settings
        $service_settings = ServicesSettings::where('user_id',$user->id)->count();
        if($service_settings == '0')
        {
          return redirect('provider/services-settings')->with('success','warning|Please update the service settings.');
        }
        //-------------------

        $service_array = $procombos = $combo = array();
        $status = array("1"=>"Active","0"=>"In-active");
        $service = ProviderServices::leftJoin('services as material','provider_services.services_id','=','material.services_id')
        ->leftJoin('services as cat','provider_services.category','=','cat.services_id')
        ->select('provider_services.provider_services_id','provider_services.category','provider_services.quantity','provider_services.unit','provider_services.service_amount','provider_services.prescription_amount','provider_services.time_needed','provider_services.service_type','provider_services.service_status','provider_services.services_id','material.service as service','cat.service as category_name','cat.services_id as category')
        ->where('provider_services.provider_services_id', $id)->first();

        

        $service_status = $service->service_id;

        $services = Services::where('service_type',1)->get();

        foreach($services as $value)
        {
            $service_array[$value->services_id] = $value->service;
        }

        $combo_services_array = ProviderServices::leftJoin('services as material','provider_services.services_id','=','material.services_id')
        ->leftJoin('services as cat','provider_services.category','=','cat.services_id')
        ->select('material.service as service','cat.service as category_name','material.services_id','material.service_type')
        ->where('provider_services.user_id', $user->id)
        ->where('material.service','!=','')->get();

        
        if($combo_services_array != null)
        {
            
            foreach($combo_services_array  as $ser)
            {

                $index = $ser->category_name;
                if($ser->category_name == '')

                  $index = 'Combination deals';
               
                if(!isset($procombos[$index]))
                {

                    $procombos[$index] = array($ser->services_id => $ser->service);
                }else
                {
                  
                    $procombos[$index][$ser->services_id] = $ser->service;
                }

                
            }
        }
        
        //---------------------selected combos
        $edit_prescription = ProviderServices::where('user_id', $user->id)
        ->where('provider_services_id',$id)
        ->lists('services_id')
        ->first();

        //-----------------------------------------------------------------

        return view('provider.create_edit_service',compact('service','status','service_status','service_array','procombos','edit_prescription'));
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
        //
        //=======================================================validation
            $required = ($request->input('service_type') == 1) ? 'required' : '';
            $comborequired = ($request->input('service') == 2) ? 'required' : '';
            $this->validate($request,[
             'service' => $required,
             'quantity' => $required,
             'service_amount' => $required.'|numeric|min:100',
             'combo_service' => $comborequired,
             'time_needed' => 'required|numeric',
             'service_status'=>'required',
          ]);
        //================================================================
        //----------------------check service appointment status
       /* $appointmentexist = CommonController::check_appointment_exist($id);

        if($appointmentexist)
        {
          return redirect('provider/services')->with('success','danger|Sorry! This request cannot be processed, because an appointment has had for this service.');  
        }*/
        //-------------------------------------------------------------    
        $app_exist = '';
        $data = $request->all();
        
        //-------------------------------------------update combination if the service is combination
        if(isset($data['service_type']) && $data['service_type'] == '2')
        {
          $appointmentexist = CommonController::check_appointment_exist($id);

          if(!$appointmentexist)
          {
            $update = Services::where('services_id',function($query) use ($id) {
                             $query->select('services_id')->from('provider_services')->where('provider_services_id',$id);
                              })
                            ->update(['service' => $data['combo_service'],'combination' => strtolower(str_replace(' ', '', $data['combo_service']))]);
          }
          else
          {
            $app_exist = '. Service name can not be change';
          }
        }
        elseif (isset($data['service_type']) && $data['service_type'] == '1') {

          $appointmentexist = CommonController::check_appointment_exist($id);

          if(!$appointmentexist)
          {
            $update = Services::where('services_id',function($query) use ($id) {
                             $query->select('services_id')->from('provider_services')->where('provider_services_id',$id);
                              })
                            ->update(['service' => $data['service']]);
          }
          else
          {
            $app_exist = '. Service name can not be change';
          }
        }
        //------------------------
        
        $service = ProviderServices::where('provider_services_id', $id)->update([
                        'quantity' => ($data['service_type'] == 1) ? $data['quantity'] : '',
                        'service_amount' => conversion_to_cent($data['service_amount']),
                        // 'prescription_amount' => (isset($data['prescription_amount'])) ? conversion_to_cent($data['prescription_amount']) : '',
                        'time_needed' => $data['time_needed'],
                        'service_status' => $data['service_status']
                    ]);
        
        return redirect('provider/services')->with('success','success|Service details updated successfully'.$app_exist);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //----------------------check service appointment status
        $appointmentexist = CommonController::check_appointment_exist($id);

        if($appointmentexist)
        {
          return redirect('provider/services')->with('success','danger|Sorry! This request cannot be processed, because an appointment has had for this service.');  
        }
        //-------------------------------------------------------------

        $service =  ProviderServices::where('provider_services_id', $id)->first();
        $res = ProviderServices::where('provider_services_id', $id)->delete();
                Services::where('services_id', $service->services_id)->delete();
        return redirect('provider/services')->with('success','success|Service deleted successfully');
    }

    /*prescription service amount*/
    public function prescription_service(Request $request)
    {

      $this->validate($request,[
             'prescription_amount' => 'required|numeric|min:30'
          ]);
      //------------------------------------------------

      $user = Auth::user();

      $data = $request->all();

      $service = ProviderServices::where('services_id', $data['services_id'])->where('user_id',$user->id)->where('service_status',1)->update([
                        'prescription_amount' => (isset($data['prescription_amount'])) ? conversion_to_cent($data['prescription_amount']) : ''
                    ]);

      //-------------------------------------
      return redirect('provider/services')->with('success','success|Service updated successfully');

    }



    
}

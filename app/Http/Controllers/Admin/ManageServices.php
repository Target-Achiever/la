<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;



use App\Services;



use Auth;



use Alert;



class ManageServices extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $services = Services::where('service_type',1)

                            ->orWhere('service_type',4)->get();

        return view('admin.manage_services',compact('services'));

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        //

        $service_array = array();

        $services = Services::all();

        $status = array("1"=>"Active","0"=>"In-active");

        $service_status = '1';



        foreach($services as $value)

        {

            $service_array[$value->services_id] = $value->service;

        }

        return view('admin.create_edit_service',compact('status','service_status','service_array'));

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        //

        //=======================================================validation

            $this->validate($request,[

                'service' => 'required',

                'description' => 'required',

                'service_status' => 'required',

                'service_banner' => 'required'

          ]);

        //================================================================

        $user_id = Auth::user()->id;

        $pservice = new Services();

        $data = $request->all();

        $pservice->service = $data['service'];

        $pservice->description = $data['description'];

        $pservice->service_readmore = $data['service_readmore'];

        $pservice->service_status = $data['service_status'];



        if ( $request->hasFile( 'service_banner' ) ) {

            $data['service_banner'] = $data['service_banner_image'];

            /*$file = $request->file( "service_banner" );

            $photo = $user_id . "_" . time() . '.' . $file->getClientOriginalExtension();

            $data['service_banner'] = $photo;

            $file->move( public_path( 'uploads/service_banner' ), $photo );*/

        }



        $pservice->service_banner = $data['service_banner'];



        $pservice->save();



        return redirect('admin/services')->with('success','success|You are successfully added a service.');



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



        $service_array = array();

        $status = array("1"=>"Active","0"=>"In-active");

        $service = Services::where('services_id', $id)->first();

        $service_status = $service->service_id;





        $services = Services::all();

        foreach($services as $value)

        {

            $service_array[$value->services_id] = $value->service;

        }

        return view('admin.create_edit_service',compact('service','status','service_status','service_array'));

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



         //=======================================================validation

            $this->validate($request,[

             'service' => 'required',

             'description' => 'required',

             'service_status'=>'required',

             //'service_banner'=>'required',

             'service_readmore'=>'required',

          ]);

        //================================================================



        $data = $request->all();

        $user_id = Auth::user()->id;



        $Services = Services::where('services_id', $id)->first();



        if( $request->hasFile('service_banner')){

            $photo = $data['service_banner_image'];

            /*$file = $request->file( "service_banner" );

            $photo = $user_id . "_" . time() . '.' . $file->getClientOriginalExtension();

            $file->move( public_path( 'uploads/service_banner' ), $photo );*/

        }else{

            $photo = $Services->service_banner;

        }



        Services::where('services_id', $id)->update([

                        'services_id' => $id,

                        'service' => $data['service'],

                        'description' => $data['description'],

                        'service_banner' => $photo,

                        'service_readmore' => $data['service_readmore'],

                        'service_status' => $data['service_status']

                    ]);





        return redirect('admin/services')->with('success','success|Service updated successfully');

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        //

        $res = Services::where('services_id', $id)->delete();

        return redirect('admin/services')->with('success','success|Service deleted successfully');

    }

}


<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\StatusService;

use Illuminate\Http\Request;



use App\Services;



use App\User;

use App\BookAppointment;

use Auth;

use Carbon\Carbon;

use Alert;

use App\StatusMail;

use App\PaymentHistory;

class ManageUsers extends Controller

{

    protected $statusService;



    public function __construct(StatusService $statusService)

    {

        $this->statusService = $statusService;

    }

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $users =User::leftJoin('user_details', 'user_details.user_id', '=', 'users.id')

            ->select('user_details.phone', 'users.*')

            ->where('users.user_type','=','end_user')

            ->whereNull('users.deleted_at')

            ->get();



        return view('admin.manage_users',compact('users'));

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function search(Request $request)

    {

        if ( $request->ajax() ) {



            $output = "";



            $users = User::where('name','LIKE','%'.$request->search.'%')

                ->whereNull('deleted_at')

                ->where('user_type','=','end_user')

                ->get();



            /*  if ( $users ) {



                  foreach ($users as $key => $user_list) {

                      $key_val=$key+1;

                      $output .= '<tr>' .



                          '<td>' .$key_val. '</td>' .



                          '<td>' . ucfirst($user_list->name) . '</td>' .



                          '<td></td>' .



                          '<td>'. $user_list->email .'</td>' .



                          '<td><a class="btn btn-info"  href="view/'.$user_list->id.'">View</a>

                                  <a class="btn btn-info"  href="destroy/'.$user_list->id.'">Deactivate</a></td>' .



                          '</tr>';



                  }







              ]*/

        }

        return view('admin.search_result' ,compact('users'));

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

    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function view($user_id)

    {

        $users =User::leftJoin('user_details', 'user_details.user_id', '=', 'users.id')

            ->select('user_details.phone','users.*')

            ->where('users.id','=',$user_id)

            ->whereNull('users.deleted_at')

            ->get();



        $appointment =BookAppointment::leftJoin('users','appointment.provider_id','=','users.id')

            ->join('services','appointment.service_needed','=','services.services_id' )

            ->select('appointment.*','users.name as provider','services.service')

            ->where('appointment.user_id','=',$user_id)

            ->get();

        $paid = PaymentHistory::where('user_id',$user_id)
                ->where('payment_status',1)->sum('amount');    

        return view('admin.manage_view_users',compact('users','appointment','paid'));

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

        $service = ProviderServices::where('provider_services_id', $id)->first();

        $service_status = $service->service_id;



        $services = Services::all();

        foreach($services as $value)

        {

            $service_array[$value->services_id] = $value->service;

        }

        return view('provider.create_edit_service',compact('service','status','service_status','service_array'));

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

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy(Request $request)

    {



        $admin_status_text = $request->admin_status_text;

        $user_id = $request->id;



        $current_time = Carbon::now()->toDateTimeString();

        User::where('id','=',$user_id)

            ->update(['deleted_at' => $current_time]);

        /* email */

         $this->statusService->sendStatusMail($user_id,$admin_status_text,'Your profile has been deactivated!','emails.deactivate');



        StatusMail::create(['user_id' =>$user_id,'status_template'=>$admin_status_text,

            'status_type' => 'deactivate' ]);





        return redirect('admin/users')->with('success','success|User has been deactivated successfully');

    }

}


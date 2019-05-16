<?php



namespace App\Http\Controllers\Admin;



use App\Advertisement;



use App\BookAppointment;



use App\Http\Controllers\Controller;


use App\PaymentHistory;
use App\Provider_refund_policy;
use App\ProviderGallery;
use App\Services;
use App\ServicesSettings;
use App\StatusMail;


use App\User_answer;
use Carbon\Carbon;



use Illuminate\Http\Request;



use App\User;



use App\User_detail;



use App\Provider_policy;



use App\ProviderServices;



use Auth;



use App\StatusService;



use Stripe\Stripe;



use Stripe\Customer;



use Stripe\Charge;



use Stripe\Account;



use App\StripeUserAccount;



use Config;





class ManageProviders extends Controller

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

        $users = User::join ('user_details','user_details.user_id','=','users.id')

            -> leftJoin ('user_answers','users.id','=','user_answers.user_id')

            ->select('users.id','users.name','users.user_status','user_details.country','user_details.surname','user_details.phone','user_answers.prescribing_rights')

            -> where (function ($query){ $query -> where('users.user_status','=','active')

                -> orWhere('users.user_status','=','in_active'); })

            -> where ('users.administrator_approval','=','1')

            -> where (function ($query){

                $query  -> where( 'users.user_type', '=', 'prescriber' )

                    -> orWhere( 'users.user_type', '=', 'non_prescriber' );

            })-> whereNull ('users.deleted_at')

            -> get();

            

        $page_type="Available Providers";



        return view('admin.providers',compact('users','page_type'));

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function pendingProviders()

    {

        $users = User::join('user_answers','user_answers.user_id','=','users.id')

            ->leftJoin ('user_details','users.id','=','user_details.user_id')

            ->where ('users.administrator_approval','=','2')

            ->where (function ($query){

                $query  -> where( 'users.user_type', '=', 'prescriber' )

                    -> orWhere( 'users.user_type', '=', 'non_prescriber' );

            })

            -> whereNull ('users.deleted_at')
            ->select('user_answers.*','user_details.*','users.*')
            -> get();





        $page_type="Pending Providers";

        return view('admin.pending_providers',compact('users','page_type'));

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function search(Request $request)

    {

        if ( $request->ajax()) {



            $output = "";
            $status = $request->status;

            $query_string=$request->search;

            $users = User::leftJoin( 'user_details', 'users.id', '=', 'user_details.user_id' )

                -> leftJoin ('user_answers','users.id','=','user_answers.user_id')

                -> where (function ($query){

                    $query  -> where( 'users.user_type', '=', 'prescriber' )

                        -> orWhere( 'users.user_type', '=', 'non_prescriber' );

                })

                -> where (function ($query) use ($query_string){

                    $query  -> where( 'users.name', 'LIKE', '%' . $query_string . '%' )

                        -> orWhere(  'users.user_status', 'LIKE', '%' . $query_string . '%' )

                        -> orWhere(  'users.user_status', 'LIKE', '%' . $query_string . '%' )

                        -> orWhere(  'user_details.country', 'LIKE', '%' . $query_string . '%' )

                        -> orWhere(  'user_details.state', 'LIKE', '%' . $query_string . '%' )

                        -> orWhere(  'user_details.city', 'LIKE', '%' . $query_string . '%' )

                        -> orWhere(  'user_details.phone', 'LIKE', '%' . $query_string . '%' );

                })

                -> where ('users.administrator_approval','=',$status)

                -> whereNull( 'users.deleted_at' )

                -> get();



            /*if ( $users ) {



                foreach ($users as $key => $user_list) {

                    $key_val=$key+1;

                    $output .= '<tr>' .



                        '<td>' .$key_val. '</td>' .



                        '<td>' . ucfirst($user_list->name) . '</td>' .



                        '<td>'. $user_list->country .'</td>' .



                        '<td>'. $user_list->phone .'</td>' .



                        '<td>'. $user_list->prescribing_rights .'</td>' .



                        '<td><a class="btn btn-info"  href="provider_profile/'.$user_list->user_id.'">View</a>

                             <a class="btn btn-info"  href="destroy/'.$user_list->user_id.'">Deactivate</a></td>' .



                        '</tr>';



                }





            }*/

        }

        return view( 'admin.search_result_provider',compact('users','status') );

    }

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function pendingSearch(Request $request)

    {

        if ( $request->ajax() ) {



            $output = "";



                $view_text="Verify";

                $deactivate_text="Approve";

                $query_string=$request->search;



                $users = User::join( 'user_details', 'users.id', '=', 'user_details.user_id' )

                    -> leftJoin ('user_answers','users.id','=','user_answers.user_id')

                    -> where (function ($query) use ($query_string){

                        $query  -> where( 'users.name', 'LIKE', '%' . $query_string . '%' )

                            -> orWhere(  'users.user_status', 'LIKE', '%' . $query_string . '%' )

                            -> orWhere(  'users.user_status', 'LIKE', '%' . $query_string . '%' )

                            -> orWhere(  'user_details.phone', 'LIKE', '%' . $query_string . '%' );

                    })

                    -> where( 'users.user_status', '=', 'active' )

                    -> where ('users.administrator_approval','=','2')

                    -> where (function ($query){

                        $query  -> where( 'users.user_type', '=', 'prescriber' )

                            -> orWhere( 'users.user_type', '=', 'non_prescriber' );

                    })

                    -> whereNull( 'users.deleted_at' )

                    -> get();



            if ( $users ) {



                foreach ($users as $key => $user_list) {



                    $key_val=$key+1;

                    $output .= '<tr>' .



                        '<td>' .$key_val. '</td>' .



                        '<td>' . ucfirst($user_list->name) . '</td>' .



                        '<td>'. $user_list->country .'</td>' .



                        '<td>'. $user_list->phone .'</td>' .



                        '<td>'. $user_list->prescribing_rights .'</td>' .



                        '<td><label>'. $user_list->aesthetic_treatment.'</label></td>' .



                        '<td><a class="btn btn-info"  href="view/'.$user_list->user_id.'">Verify</a>

                                <a class="btn btn-info"  href="approve/'.$user_list->user_id.'">Approve</a>

                                </td>' .



                        '</tr>';



                }



                return Response( $output );

            }

        }



    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function profile($user_id)

    {

        $users = User::leftJoin('user_details', 'user_details.user_id', '=', 'users.id')

            ->leftJoin('user_answers', 'user_answers.user_id', '=', 'users.id')

            ->select('user_details.*','users.*','user_answers.*')

            ->where('users.id','=',$user_id)

            ->whereNull('users.deleted_at')

            ->get();



        $policy = Provider_policy::where('user_id',$user_id)->get();



        $service_type = array('1' => 'Regular','2' => 'Combination deals','3' => 'Service material');
        /*$services = ProviderServices::join('services','services.services_id','=','provider_services.services_id')

                    ->where('provider_services.user_id',$user_id)->get();*/

        $services = ProviderServices::join('services as material','provider_services.services_id', '=','material.services_id')
            ->leftJoin('services as cat','provider_services.category','=','cat.services_id')
            ->select('provider_services.*', 'material.service as materialName','provider_services.quantity','cat.service as category','material.service_type','material.combination')
            ->where('provider_services.user_id',$user_id)
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

        $appointment = BookAppointment::where('provider_id',$user_id)

            ->where('payment_status','=','1')

            ->get();



        $advertisement = Advertisement::join('services','services.services_id','=','advertisement.service')

                    ->where('advertisement.user_id',$user_id)->get();



        return view('admin.manage_view_provider',compact('users','policy','service_type','services','appointment','advertisement'));

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function pending($user_id)

    {

        $users =User::leftJoin('user_details', 'user_details.user_id', '=', 'users.id')

                ->leftJoin('user_answers', 'user_answers.user_id', '=', 'users.id')

                ->select('user_details.*','users.*','user_answers.*')

                ->where('users.id','=',$user_id)

                ->whereNull('users.deleted_at')

                ->get();



        return view('admin.manage_view_pending_provider',compact('users'));

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function approve(Request $request)

    {

        $user_id=$request->user_id;

        $admin_status_text=$request->admin_status_text;



        User::where('id',$user_id)

            ->update(['administrator_approval' => "1"]);



        /* email */

         $this->statusService->sendStatusMail($user_id,$admin_status_text,'Your profile has been approved!','emails.approve');



        StatusMail::create(['user_id' =>$user_id,'status_template'=>$admin_status_text,

            'status_type' => 'approve' ]);

 

        //--------------------------------------------create stripe account

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $exist = StripeUserAccount::where('user_id',$user_id)->first();





        // if($exist === null)

        // {

        //     $createprovideraccount = Account::create(array(

        //         "country" => config::get('constants.country'),//united kindom

        //         "type" => "custom"

        //     ));



        //     StripeUserAccount::insert(['user_id' => $user_id,'account' => $createprovideraccount->id,'secret_key' => $createprovideraccount->keys->secret,'publishable_key' => $createprovideraccount->keys->publishable,'ac_created_at' => $createprovideraccount->created,'stripe_response' => json_encode($createprovideraccount),'created_at' => Carbon::now(),'updated_at' => Carbon::now()]);

        // }



        //----------------------------------------------------------------

   return redirect('admin/pending_providers')

            ->with('success','success|Provider has been approved successfully');



    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function reject(Request $request)

    {

        $user_id = $request->user_id;

        $admin_status_text = $request->admin_status_text;



        User::where('id','=',$user_id)->update(['administrator_approval' => '3']);

        /* email */

        $this->statusService->sendStatusMail($user_id,$admin_status_text,'Your profile has been rejected!','emails.reject');



        StatusMail::create(['user_id' =>$user_id,'status_template'=>$admin_status_text,

            'status_type' => 'reject' ]);



        return redirect('admin/pending_providers')

            ->with('success','danger|Provider has been rejected successfully');



    }





    /**

     * @param Request $request

     * @return \Illuminate\Http\RedirectResponse

     */

    public function delete(Request $request)

    {

        $user_id = $request->id;

        $Type = $request->admin_status_text;
        $admin_status_text = "";
        /* email */
         $this->statusService->sendStatusMail($user_id,$admin_status_text,'Your profile has been deleted!','emails.delete');
        if($Type == 'user'){

            User_detail::where('user_id',$user_id)->delete();
            User::where('id',$user_id)->delete();

            return redirect('admin/users')
                ->with('success','success|User has been deleted successfully');
        }else{
            Provider_refund_policy::where('user_id',$user_id)->delete();
            PaymentHistory::where('user_id',$user_id)->delete();
            ProviderGallery::where('user_id',$user_id)->delete();
            Provider_policy::where('user_id',$user_id)->delete();
            ServicesSettings::where('user_id',$user_id)->delete();
            StatusMail::where('user_id',$user_id)->delete();
            StripeUserAccount::where('user_id',$user_id)->delete();
            User_answer::where('user_id',$user_id)->delete();
            User_detail::where('user_id',$user_id)->delete();
            User::where('id',$user_id)->delete();

//        StatusMail::create(['user_id' =>$user_id,'status_template'=>$admin_status_text,'status_type' => 'delete' ]);

            return redirect('admin/providers')
                ->with('success','success|Provider has been deleted successfully');
        }
    }



    /**

     * @param Request $request

     * @return \Illuminate\Http\RedirectResponse

     */

    public function deactivate(Request $request)

    {



        $admin_status_text = $request->admin_status_text;

        $provider_id = $request->provider_id;



        User::where('id',$provider_id)

            ->update(['user_status' => 'in_active']);

        /* email */

        $this->statusService->sendStatusMail($provider_id,$admin_status_text,'Your profile has been deactivated!','emails.deactivate');



        StatusMail::create(['user_id' =>$provider_id,'status_template'=>$admin_status_text,

            'status_type' => 'deactivate' ]);



        return redirect('admin/providers')

            ->with('success','success|Provider has been deactivated successfully');



    }



    /**

     * @param Request $request

     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response

     */

    public function active(Request $request)

    {



        $provider_id = $request->provider_id;

        $admin_status_text = $request->admin_status_text;



        User::where('id',$provider_id)

            ->update(['user_status' => 'active']);



        /* email */

        $this->statusService->sendStatusMail($provider_id,$admin_status_text,'Your profile has been activated!','emails.active');



        StatusMail::create(['user_id' =>$provider_id,'status_template'=>$admin_status_text,

            'status_type' => 'active' ]);



        return redirect('admin/providers')

            ->with('success','success|Provider has been activated successfully');



    }



}


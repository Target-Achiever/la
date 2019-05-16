<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;



use App\User;



use App\Provider_policy;



use Auth;



use Alert;



class ProviderPoliciesController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {



        $users =User::join('provider_policies','provider_policies.user_id','=','users.id')

            ->select('users.name','provider_policies.*')

            ->groupBy('provider_policies.user_id')

            ->get();



        return view('admin.policies',compact('users'));

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        //

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

    public function show($id)

    {

        //

        $users =User::join('provider_policies','provider_policies.user_id','=','users.id')

            ->select('users.*')

            ->lists('name','id');



        $policiesdata=Provider_policy::where('user_id',$id)

            ->orderBy('created_at','desc')

            ->get();



        foreach ($policiesdata as $key => $policy) 

        {

            $policies[$policy->policy_type][] = $policy;

        }    



        $policy_arr=array("cancel"=>"Cancellation Policy","reschedule"=>"Reschedule Policy","dissatisfaction"=>"Customer Dissatisfaction");



        // return view('admin.policies',compact('users','policies','policy_arr','id'));

        return view('modal-body.provider_policy_Sadmin',compact('users','policies','policy_arr','id'));

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

    public function destroy($id)

    {

        //

    }

}


<?php



namespace App\Http\Controllers\Prescriber;

use App\Http\Controllers\Controller;

use App\Provider_refund_policy;

use Illuminate\Http\Request;



use App\Services;



use App\Provider_policy;



use Auth;



use Alert;

use Stripe\Refund;



class ProviderPolicyController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $policies =Provider_policy::where('user_id',Auth::user()->id)

            ->orderBy('created_at','desc')

            ->get()

            ->unique('policy_type');



        $refund = Provider_refund_policy::where('user_id',Auth::user()->id)->first();



        $policy_arr=array("cancel"=>"Cancellation Policy","reschedule"=>"Reschedule Policy","dissatisfaction"=>"Customer Dissatisfaction");



        return view('provider.policies',compact('policies','policy_arr','refund'));

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



        //=======================================================validation

            $this->validate($request,[

             'policy'=>'required'

          ]);

        //================================================================



        $policy = new Provider_policy();

        $data = $request->all();

        $policy->user_id = Auth::user()->id;

        $policy->policy = $data['policy'];

        $policy->policy_type = $data['policy_type'];

        $policy->save();
       

        return redirect('provider/policies')->with('success','success|You are update the policy successfully.');

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

    public function ProviderPolicyModal($type){



        $policies =Provider_policy::where('user_id',Auth::user()->id)

            ->where('policy_type','=',$type)

            ->orderBy('created_at','desc')

            ->first();



        return view('modal-body.provider_policies_modal',compact('type','policies'));

    }

    public function refund(Request $request, $id)

    {

        $data = $request->all();

        $data['refund'] = 1;
        if($data['percentage_week'] == '0' && $data['percentage_days'] == '0' && $data['percentage_appointment_day'] == '0')
        {
            $data['refund'] = 0;
        }

        Provider_refund_policy::where('user_id',$id)->update($data);



        return redirect('provider/policies')->with('success','success|Cancellation policy successfully updated.');

    }

}


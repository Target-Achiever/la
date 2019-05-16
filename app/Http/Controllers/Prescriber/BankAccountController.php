<?php



namespace App\Http\Controllers\prescriber;



use Illuminate\Http\Request;



use App\Http\Requests;



use App\Http\Requests\CreateBankAccountRequest;



use App\Http\Controllers\Controller;



use App\BankAccount;



use Auth;



use App\StripeUserAccount;



use Stripe\Stripe;



use Stripe\Account;



use Config;





class BankAccountController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        //

        $account = BankAccount::where('user_id',Auth::user()->id)->first();



        $info = array();

        if($account != null)

        {



            $info = json_decode($account->account_info, true);

            $info['user_id'] = $account->user_id;

        }



        return view('provider.bank_account_settings',compact('info'));

        

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        //



        $account = BankAccount::where('user_id',Auth::user()->id)->first();



        $info = array();

        if($account != null)

        {



            $info = json_decode($account->account_info, true);

            

        }



        return view('provider.bank_account_settings',compact('info'));

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(CreateBankAccountRequest $request)

    {

        //

        

        $user = Auth::user();



        $stripAc = StripeUserAccount::where('user_id',$user->id)->first();

        

        if($stripAc != null)

        {





            try 

            {

                Stripe::setApiKey(env('STRIPE_SECRET'));



                $account = Account::retrieve($stripAc->account);



                //create connected bank account

                $connectAc = $account->external_accounts->create(array("external_account" => array("object" => "bank_account",'country' => config::get('constants.country'),'currency' => config::get('constants.currency_code'),'account_holder_type' => 'individual','account_number' => $_POST['account_number'])));

                

                //update connected account

                $account->legal_entity->type = $_POST['entity_type'];

                $account->legal_entity->first_name = $_POST['entity_first_name'];

                $account->legal_entity->last_name = $_POST['entity_last_name'];

                $account->legal_entity->dob->day = $_POST['entity_dob_day'];

                $account->legal_entity->dob->month = $_POST['entity_dob_month'];

                $account->legal_entity->dob->year = $_POST['entity_dob_year'];

                $account->tos_acceptance->date = time();

                $account->tos_acceptance->ip = request()->server('SERVER_ADDR');//fields required

                $account->payout_schedule->delay_days = 'minimum';

                $account->payout_schedule->interval = 'daily';

                // // $account->legal_entity->ssn_last_4 =null;

                // $account->legal_entity->address->state = $_POST['entity_state'];

                // $account->legal_entity->address->city = $_POST['entity_city'];

                // $account->legal_entity->address->postal_code = $_POST['entity_postal_code'];

                $account->save();



                $create = BankAccount::create(['user_id' => $user->id,'account_id' => $connectAc->id,'account_info' => json_encode($_POST),'stripe_response' => json_encode($connectAc)]);





            } catch (\Exception $ex) 

            {



                return redirect('provider/bank-account')->with('success','danger|'.$ex->getMessage());

            }

        }else

        {

            return redirect('provider/bank-account')->with('success','danger|Oops!, Something went wrong');

        }



        return redirect('provider/bank-account')->with('success','success|Your account info created successfully');

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

    public function update(CreateBankAccountRequest $request, $id)

    {

        //

        

        $update = BankAccount::where('user_id',$id)->update(['account_info' => json_encode($_POST)]);



        return redirect('provider/bank-account')->with('success','success|Your account info updated successfully');

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



    public function remove_stripe_bank_account(Request $request,$userid)

    {

        $accountinfo = StripeUserAccount::leftJoin('bank_account','stripe_user_account.user_id','=','bank_account.user_id')

            ->select('stripe_user_account.account','bank_account.account_id','bank_account.id')

            ->where('stripe_user_account.user_id',$userid)->first();



            



        if($accountinfo != null)

        {



            Stripe::setApiKey(env('STRIPE_SECRET'));

            //-------------------------------------

            try

            {

                $account = Account::retrieve($accountinfo->account);

                $delete = $account->external_accounts->retrieve($accountinfo->account_id)->delete();

            

            }catch (\Exception $ex) 

            {

                $message  = 'errro|'.$ex->getMessage();;

                

            }





            if(isset($delete->deleted) && $delete->deleted)

            {

                BankAccount::where('id',$accountinfo->id)

                            ->where('user_id',$userid)

                            ->delete();



                $message = 'success|Account removed, please create give another bank details for the future payment.';



            }

    

        }

        else

        {

            $message = 'danger|No account found, No account found to remove.';

        }

        //---------------------------------------------------------------------

         return redirect('provider/bank-account')->with('success',$message);

    }

}


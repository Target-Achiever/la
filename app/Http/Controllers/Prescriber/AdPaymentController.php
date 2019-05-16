<?php



namespace App\Http\Controllers\prescriber;



use Illuminate\Http\Request;



use App\Http\Requests;



use App\Http\Controllers\Controller;



use App\Advertisement;



use Auth;



use Stripe\Stripe;



use Stripe\Customer;



use Stripe\Charge;



use App\StripeUserAccount;



use Stripe\Account;



use Stripe\Transfer;



use Carbon\Carbon;



use App\PaymentHistory;



use App\LaPaymentHistory;



use DB;



use App\User_detail;



use App\Services;



use Mail;



use App\User;



use Config;



class AdPaymentController extends Controller

{

    public static function advertisement_payment(Request $request,$getadid)

    {



    	$userData = Auth::user();

        $adData = Advertisement::leftJoin('users','advertisement.user_id','=','users.id')

            ->select('advertisement.*','users.name','users.email')->where('advertisement.id',$getadid)->first();

        //----------------------------------------------------------make payment

        if($adData != null)

        {

	        try {



					Stripe::setApiKey(env('STRIPE_SECRET'));//

					//----------------------------------------sripe function

				    $customer = Customer::create(array(

				        'email' => $request->stripeEmail,

				        'source' => $request->stripeToken

				    ));

				    //-------------------------------charge

				    $destinationAmount = $adData->amount;

				    // $destinationAmount = 1000;



				    $charge = Charge::create(array(

				        'customer' => $customer->id,

				        'amount' => $destinationAmount,

				        'currency' => config::get('constants.currency_code')

				    ));



				    if($charge->paid)

				    {



				    	$message = 'success|You have successfully created your advertisement. We will display the advertisement as per your settings.';



				    	$insert_history = PaymentHistory::create(['user_id' => $userData->id,'paid_to' => '','paid_for_id' => $getadid,'payment_type' => 2,'amount' => $destinationAmount,'transaction_id' => $charge->id,'payment_date' => Carbon::now(),'payment_status' => 1,'description' => '']);



				    	$updateApp = Advertisement::where('id',$getadid)

					  				->update(['ad_status' => 1,'ad_payment_status' => 1,'payment_id' => $insert_history->id]);



						//----------------------------------------sent mail

					  	$toMail = array(config::get('constants.admin_mail'),$adData->email);

						Mail::send('emails.paid_advertisement', ['adInfo' =>$adData],function ($m) use ($adData,$toMail){

				            $m->from('Info@linkaesthetics.com', 'LinkAesthetics');



				            $m->to($toMail)->subject('Advertisement payment confirmation');

				        });

				    }

				    else

				    {

				    	$message = 'danger|Advertisement can not be displayed due to failed transaction.';

				    	return $message;

				    }



				} catch (\Exception $ex) {

				    return $message  = 'danger|'.$ex->getMessage();

				}

				return $message;

		}

		else

		{

			$message = 'danger|Oops!, Your payment request not valid.';

			return $message;

		}



    }

}


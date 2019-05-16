<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;



use App\Http\Requests;



use App\BookAppointment;



use Auth;



use Stripe\Stripe;



use Stripe\Customer;



use Stripe\Charge;



use App\StripeUserAccount;



use Stripe\Account;



use Stripe\Transfer;



use Stripe\Refund;



use Carbon\Carbon;



use App\PaymentHistory;



use App\LaPaymentHistory;



use DB;



use App\User_detail;



use App\Services;



use Mail;



use App\User;



use Config;



use App\Http\Controllers\CommonController;



use App\ProviderWallet;



use App\CancelledAppointment;



class PaymentCheckoutController extends Controller

{

    //

    public function appointment_payment(Request $request,$appointmentid)

    {

        $userData = Auth::user();



        $appointment_id = \Crypt::decrypt($appointmentid);



        $getappid = explode('-',$appointment_id);



        $getappid = end($getappid);





        $appData = BookAppointment::leftJoin('users','appointment.provider_id','=','users.id')

                    ->leftJoin('user_details','appointment.provider_id','=','user_details.user_id')

                    ->leftJoin('services','appointment.service_needed','=','services.services_id')

                    ->leftJoin('services as cat','services.category','=','cat.services_id')

                    ->select('appointment.*','users.name as provider_name','services.service','users.email','user_details.address_line_1','user_details.address_line_2','user_details.phone','cat.service as service_name','services.service_type')

                    ->where('appointment.id',$getappid)->first();

        //----------------------------------------------------------make payment

        try {

                Stripe::setApiKey(env('STRIPE_SECRET'));



                $exist = StripeUserAccount::where('user_id',$appData->provider_id)->first();





                if($exist === null)

                {

                    $createprovideraccount = Account::create(array(

                        "country" => config::get('constants.country'),

                        "type" => "custom"

                    ));







                    $destination_ac = $createprovideraccount->id;



                    StripeUserAccount::insert(['user_id' => $appData->provider_id,'account' => $createprovideraccount->id,'secret_key' => $createprovideraccount->keys->secret,'publishable_key' => $createprovideraccount->keys->publishable,'ac_created_at' => $createprovideraccount->created,'stripe_response' => json_encode($createprovideraccount),'created_at' => Carbon::now(),'updated_at' => Carbon::now()]);

                }else

                {

                    $destination_ac = $exist->account;

                }



                //----------------------------------------sripe function

                $customer = Customer::create(array(

                    'email' => $request->stripeEmail,

                    'source' => $request->stripeToken

                ));

                //-------------------------------charge

                $destinationAmount = $appData->service_amount;

                // $appData->service_amount - (config('constants.administartor_percent') / 100) * $appData->service_amount;//not required



                $charge = Charge::create(array(

                    'customer' => $customer->id,

                    'amount' => $destinationAmount,

                    'currency' => config::get('constants.currency_code')

                ));



                // $charge = true;



                if($charge->paid)

                {



                    //-------------------update appoint table payment status





                    $insert_history = PaymentHistory::create(['user_id' => $userData->id,'paid_to' => $appData->provider_id,'paid_for_id' => $getappid,'payment_type' => 1,'amount' => $destinationAmount,'transaction_id' => $charge->id,'payment_date' => Carbon::now(),'payment_status' => 1,'description' => '','stripe_response' => json_encode($charge)]);



                    $updateApp = BookAppointment::where('id',$getappid)

                                    ->update(['payment_status' => 1,'payment_id' => $insert_history->id]);



                    CommonController::insert_notification(array('action_id' => $insert_history->id,'type' => 3,'from' => $userData->id,'to' => $appData->provider_id,'message' => ' has made a payment.'));





                    //-------------------------------------------

                    $wallet = ProviderWallet::where('user_id',$appData->provider_id)->orderBy('id','desc')->first();



                    $credited = $appData->service_amount - (config('constants.administartor_percent') / 100) * $appData->service_amount;



                    $amount = ($wallet != null) ? (float)$credited + (float)$wallet->balance : $credited;



                    ProviderWallet::create(['user_id' => $appData->provider_id,'amount_credited' => $credited,'balance' => $amount,'type' => 1,'payment_history_id' => $insert_history->id]);

                    //------------------appointment mail

                    if($updateApp)

                    {



                        $toMail = array($userData->email,$appData->email);

                        Mail::send('emails.user_app_confirmed', ['transaction_id' => $charge->id,'name' => $userData->name,'appInfo' =>$appData],function ($m) use ($appData,$toMail){

                            $m->from('Info@linkaesthetics.com', 'LinkAesthetics');



                            $m->to($toMail)->subject('Appointment confirmation');

                        });

                        //------------------------

                        return redirect()->back()->with('success','success|Payment successful, Your payment has been successfully processed.');

                    }

                    else

                    {

                        return redirect()->back()->with('success','danger|Oops!, Your payment request not completed. Please try later.');

                    }

                    //------------------------------------------------------



                }

                else

                {

                    return redirect()->back()->with('success','danger|Oops!', 'Your payment process incomplete. Please try again.');

                }



            } catch (\Exception $ex) {

                return redirect()->back()->with('success','danger|'.$ex->getMessage());

            }







        //----------------------------------------------------------end





    }

    public function cancel_appointment(Request $request,$appointmentid)

    {

        $userData = Auth::user();



        $appointment_id = \Crypt::decrypt($appointmentid);



        $getappid = explode('-',$appointment_id);



        $getappid = end($getappid);





        $appData = BookAppointment::leftJoin('users','appointment.provider_id','=','users.id')

                    ->leftJoin('users as requester','appointment.user_id','=','requester.id')

                    ->leftJoin('user_details','appointment.provider_id','=','user_details.user_id')

                    ->leftJoin('services','appointment.service_needed','=','services.services_id')

                    ->leftJoin('services as cat','services.category','=','cat.services_id')

                    ->leftJoin('provider_refund_policies','appointment.provider_id','=','provider_refund_policies.user_id')

                    ->leftJoin('payment_history','appointment.id','=','payment_history.paid_for_id')

                    ->select('appointment.*','users.name as provider_name','services.service','users.email','requester.email as requester_email','requester.name as requester_name','user_details.address_line_1','users.user_type','provider_refund_policies.refund','provider_refund_policies.percentage_week','provider_refund_policies.percentage_days','provider_refund_policies.percentage_appointment_day','payment_history.transaction_id','cat.service as service_name','services.service_type')

                    ->where('appointment.id',$getappid)

                    ->first();



         $user1_type = $userData->user_type;

         $user2_type = $appData->user_type;

        //----------------------------------------------------------make payment

        if($appData != null)

        {

            try{

                    Stripe::setApiKey(env('STRIPE_SECRET'));

                    //--------------------------------------

                    if($userData->user_type == 'end_user' || ($user1_type == 'non_prescriber' && $user2_type == 'prescriber'))

                    {





                        if($appData->payment_status == 2 && ($appData->appointment_status == 1 || $appData->appointment_status == 2))//not paid and appointment status in request(not accepted)

                            {

                                BookAppointment::where('id',$appData->id)->update(['appointment_status' => 4]);



                                //---------------------------------------------------------------

                                CommonController::insert_notification(array('action_id' => $appData->id,'type' => 1,'from' => $userData->id,'to' => $appData->provider_id,'message' => ' has cancelled your appointment.'));

                                //----------------------------------------------------------------



                                return redirect()->back()->with('success','success|Your appointment request has been cancelled.');

                                exit;



                            }

                            //-------------------------calculate refund

                            $destinationAmount = 0;

                            $refund_id = 'no refund';

                            if($appData->refund)

                            {

                                //--------------------------------------------refund the amount

                                $date = Carbon::parse($appData->preferred_date);



                                $now = Carbon::today();



                                $diff = $now->diffInDays($date);



                                $diffInHours = Carbon::now()->diffInHours($appData->preferred_date.''.$appData->appointment_time_from);

                                //-------------------------------------------------------------



                                $destinationAmount = ($appData->percentage_days / 100) * $appData->service_amount;

                                $percentage_to_user = $appData->percentage_days;

                                if($diffInHours <= 24)

                                {



                                    $destinationAmount = ($appData->percentage_appointment_day / 100) * $appData->service_amount;

                                    $percentage_to_user = $appData->percentage_appointment_day;

                                }

                                else if($diff > 7)//days more than a week

                                {



                                    $destinationAmount = ($appData->percentage_week / 100) * $appData->service_amount;

                                    $percentage_to_user = $appData->percentage_week;

                                }

                                $refund = Refund::create([

                                'charge' => $appData->transaction_id,

                                'amount' => $destinationAmount,

                                ]);



                                if($refund->status = "succeeded")

                                {

                                    $refund_id = $refund->id;

                                    //deduct the amount from provider wallet

                                    $wallet = ProviderWallet::where('user_id',$appData->provider_id)->orderBy('id','desc')->first();



                                    $amount_due = 0;

                                    if($wallet->balance != '' && $wallet->balance >= $destinationAmount)

                                    {



                                        $amount = (float)$wallet->balance - (float)$destinationAmount;//provider current balance

                                    }

                                    else

                                    {

                                        $amount = 0;

                                        $amount_due = (float)$destinationAmount - (float)$wallet->balance;

                                    }



                                    $la_share_amount  = 0;

                                    $la_share_percentage = config::get('constants.administartor_percent');

                                    if($percentage_to_user == 100)

                                    {

                                        $la_share_amount = (config::get('constants.administartor_percent') / 100) * $appData->service_amount;

                                        $la_share_percentage = 0;

                                    }

                                    //---------------------update payment history

                                    $insert_history = PaymentHistory::create(['user_id' => $appData->provider_id,'paid_to' => $appData->user_id,'paid_for_id' => $appData->id,'payment_type' => 3,'amount' => $destinationAmount,'transaction_id' => $refund->id,'payment_date' => Carbon::now(),'payment_status' => 1,'description' => '','stripe_response' => json_encode($refund),'la_share_percentage'=> $la_share_percentage,'la_share_amount' => $la_share_amount]);

                                    //-------------------------------------------

                                    ProviderWallet::create(['user_id' => $appData->provider_id,'amount_debited' => $destinationAmount,'balance' => $amount,'type' => 2,'payment_history_id' => $insert_history->id,'amount_due' => $amount_due]);

                                    //-------------------------------------------update cancelled_appointment table

                                    CancelledAppointment::create(['user_id' => $appData->user_id,'user_type' => $userData->user_type,'appointment_type' => $appData->appointment_type,'appointment_id' => $appData->id,'status' => 3]);

                                }



                                BookAppointment::where('id',$appData->id)->update(['appointment_status' => 4]);

                                //------------------------------------------------------------

                                $message = "success|Your appointment has been cancelled and refund will be credited to your account within 4-5 working days.";

                                //-------------------------------------------------------------



                            }

                            else

                            {

                                BookAppointment::where('id',$appData->id)->update(['appointment_status' => 4]);

                                //----------------------------------------------------------------



                                $message = "success|Your appointment has been cancelled. According to the consulting person's cancellation policies you will not receive any refund.";

                            }



                            //-------------------------------------------------------------------

                            CommonController::insert_notification(array('action_id' => $appData->id,'type' => 1,'from' => $userData->id,'to' => $appData->provider_id,'message' => ' has cancelled your appointment.'));



                            //-----------------------mail

                            $toMail = array($appData->email,$appData->requester_email);

                            Mail::send('emails.appointment_cancelled', ['refund_id' => $refund_id,'name' => $userData->name,'appInfo' =>$appData,'refund_amount' => $destinationAmount],function ($m) use ($appData,$toMail){

                                $m->from('Info@linkaesthetics.com', 'LinkAesthetics');



                                $m->to($toMail)->subject('Appointment cancelled');

                            });

                            return redirect()->back()->with('success',$message);

                            //--------------------------------------------------------------------



                    }

                    else if($appData->user_type == 'non_prescriber' || $appData->user_type == 'prescriber')

                    {



                    // else if(($user1_type == 'prescriber' && $user2_type == 'end_user' ) || ($user1_type == 'prescriber' && $user2_type == 'non_prescriber') || ($user1_type == 'non_prescriber'  && $user2_type == 'end_user'))

                        if($appData->payment_status == 2 && ($appData->appointment_status == 1 || $appData->appointment_status == 2))//not paid and appointment status in request(not accepted)

                            {

                                BookAppointment::where('id',$appData->id)->update(['appointment_status' => 5]);



                                //---------------------------------------------------------------

                                CommonController::insert_notification(array('action_id' => $appData->id,'type' => 1,'from' => $userData->id,'to' => $appData->user_id,'message' => ' has cancelled your appointment.'));

                                //----------------------------------------------------------------

                                //mail

                                $toMail = array($appData->requester_email);



                                Mail::send('emails.appointment_declined', ['appInfo' =>$appData],function ($m) use ($appData,$toMail){

                                    $m->from('Info@linkaesthetics.com', 'LinkAesthetics');



                                    $m->to($toMail)->subject('Appointment declined');

                                });

                                //mail end



                                return redirect()->back()->with('success','success|Your appointment request has been declined.');

                                exit;



                            }



                            $refund = Refund::create([

                                'charge' => $appData->transaction_id,

                                'amount' => $appData->service_amount,

                                ]);



                            if($refund->status = "succeeded")

                            {

                                $wallet = ProviderWallet::where('user_id',$appData->provider_id)->orderBy('id','desc')->first();



                                $amount_due = 0;

                                if($wallet->balance != '' && $wallet->balance >= $appData->service_amount)

                                {



                                    $amount = (float)$wallet->balance - (float)$appData->service_amount;//provider current balance

                                }

                                else

                                {

                                    $amount = 0;

                                    $amount_due = (float)$appData->service_amount - (float)$wallet->balance;

                                }



                                $la_share_amount = (config::get('constants.administartor_percent') / 100) * $appData->service_amount;

                                //---------------------update payment history

                                $insert_history = PaymentHistory::create(['user_id' => $appData->provider_id,'paid_to' => $appData->user_id,'paid_for_id' => $appData->id,'payment_type' => 3,'amount' => $appData->service_amount,'transaction_id' => $refund->id,'payment_date' => Carbon::now(),'payment_status' => 1,'description' => '','stripe_response' => json_encode($refund)]);

                                //-------------------------------------------

                                ProviderWallet::create(['user_id' => $appData->provider_id,'amount_debited' => $appData->service_amount,'balance' => $amount,'type' => 2,'payment_history_id' => $insert_history->id,'amount_due' => $amount_due]);

                                //-------------------------------------------update cancelled_appointment table

                                CancelledAppointment::create(['user_id' => $appData->provider_id,'user_type' => $userData->user_type,'appointment_type' => $appData->appointment_type,'appointment_id' => $appData->id,'status' => 2]);



                                BookAppointment::where('id',$appData->id)->update(['appointment_status' => 5]);

                                //-----------------------------------------------------------------

                                $message = "success|Your appointment has been cancelled. As per the link aesthetics rule you will not receive any amount.";



                            }

                            else

                            {

                                    $message = "danger|Something went wrong please try later.";



                            }

                            //---------------------------------------------------------------actions

                            CommonController::insert_notification(array('action_id' => $appData->id,'type' => 1,'from' => $userData->id,'to' => $appData->user_id,'message' => ' has canncelled your appointment.'));

                            //-----------------------mail

                            $toMail = array($appData->email,$appData->requester_email);

                            Mail::send('emails.appointment_cancelled', ['refund_id' => $refund->id,'name' => $userData->name,'appInfo' =>$appData,'refund_amount' => $appData->service_amount],function ($m) use ($appData,$toMail){

                                $m->from('Info@linkaesthetics.com', 'LinkAesthetics');



                                $m->to($toMail)->subject('Appointment cancelled');

                            });

                            return redirect()->back()->with('success',$message);

                            //---------------------------------------------------------------------

                    }



                }

                catch (\Exception $ex) {

                    return redirect()->back()->with('success','danger|'.$ex->getMessage());

                }

        }

        else

        {

            return redirect()->back()->with('success','danger|Your appointment cancellation request not completed. Please try again.');

        }



    }



    //-----------------------------------------------------------------------------

    public function transfer_merachant_to_provider()

    {



        Stripe::setApiKey(env('STRIPE_SECRET'));//merchant account secret key

        //--------------------------------------





            //---------------------------------code to run

            $transfer_amount = BookAppointment::leftJoin('stripe_user_account','appointment.provider_id','=','stripe_user_account.user_id')

                        ->leftJoin('la_payment_history','appointment.id','=','la_payment_history.paid_for_id')

                        ->leftJoin('payment_history','appointment.id','=','payment_history.paid_for_id')

                        ->leftJoin('users','appointment.provider_id','=','users.id')

                        ->where('appointment.appointment_status','=',2)//provder accepted appointment

                        ->where('appointment.payment_status','=',1)//amount paid

                        ->where('payment_history.payment_status',1)

                        ->whereDate('appointment.preferred_date','<', Carbon::today()->subDays(1))//transfer after seven days

                        ->whereNotNull('stripe_user_account.account')//account should not be null

                        ->select('appointment.id','appointment.provider_id','appointment.service_amount','stripe_user_account.account','payment_history.transaction_id','users.email','users.name')

                        ->whereNOTIn('appointment.id',function($query){

                           $query->select('paid_for_id')->from('la_payment_history')->where('payment_status',1);

                        })//already paid for this pending transation

                        ->get();



            //----------------------------------loop

        if($transfer_amount->count())

        {



            $transfer_id = '';

            foreach($transfer_amount  as $app)

            {

                $la_share_amount = 0;



                $administartor_percent = config('constants.administartor_percent');





                //-------------------------------------------retreive charge object



                $retrieve_charge = Charge::retrieve($app->transaction_id);



                if($retrieve_charge->amount_refunded == 0)

                {



                  $destinationAmount = $retrieve_charge->amount - ($administartor_percent / 100) * $app->service_amount;

                }

                else if($retrieve_charge->amount_refunded > 0)

                {

                  $destinationAmount = ($administartor_percent / 100) * ($retrieve_charge->amount - $retrieve_charge->amount_refunded);

                }





                $la_share_amount = $app->service_amount - $destinationAmount;

                try {

                // die();

                        $transferStatus = 1;

                        $message = 'paid';

                        //-----------------------------------stripe transaction section



                        $transfer = Transfer::create(array(

                          "amount" => 1,

                          "currency" => 'USD',

                          "destination" => $app->account

                        ));









                        $transfer_id = $transfer->id;



                    } catch (\Exception $ex) {

                        $message  = $ex->getMessage();

                        $transferStatus = 2;

                    }

                //-----------------------------------------------update lApaymenthistory

                $lapaymenthistory[] = [

                'user_id' => $app->provider_id,

                'paid_for_id' => $app->id,

                'payment_type' => 1,

                'account' => $app->account,

                'amount'  => $destinationAmount,

                'la_share_percentage' => $administartor_percent,

                'la_share_amount' => $la_share_amount,

                'transaction_id' => $transfer_id,

                'payment_date'  => Carbon::now(),

                'payment_status'  => $transferStatus,

                'description' => $message,

                'stripe_response' => json_encode($transfer),

                'created_at'  => Carbon::now(),

                'updated_at'  => Carbon::now()

                ];

                //----------------------------------------------mail

                $toMail = array($app->email,config::get('constants.admin_mail'));

                Mail::send('emails.stripe_transfer_to_provider', ['name' => $app->name,'mailContent' =>$transfer],function ($m) use ($app,$toMail){

                        $m->from('Info@linkaesthetics.com', 'LinkAesthetics');

                        $m->to($toMail)->subject('Payment confirmation');

                    });

                //--------------------------------------------------

            }

            //--------------------------------------loop end

            //la payment history bulk insert

            $insert_history = LaPaymentHistory::insert($lapaymenthistory);



        }



    }

}


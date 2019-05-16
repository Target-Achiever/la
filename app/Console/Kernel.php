<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
//----------------------
use App\BookAppointment;

use Auth;

use Carbon\Carbon;

use Stripe\Stripe;

use Stripe\Transfer;

use Config;

use App\LaPaymentHistory;

use App\CancelledAppointment; 

use App\Advertisement;

use DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
       
        Stripe::setApiKey(env('STRIPE_SECRET'));//merchant account secret key
        //--------------------------------------

        $schedule->call(function () 
        {
            //---------------------------------code to run
            $transfer_amount = BookAppointment::leftJoin('stripe_user_account','appointment.provider_id','=','stripe_user_account.user_id')
                        ->leftJoin('la_payment_history','appointment.id','=','la_payment_history.paid_for_id')
                        ->leftJoin('payment_history','appointment.id','=','payment_history.paid_for_id')
                        ->leftJoin('users','appointment.provider_id','=','users.id')
                        ->where('appointment.payment_status','=',1)//amount paid
                        ->where('payment_history.payment_status',1)
                        ->where('payment_history.payment_type',1)//only for appointment
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
                    
                    $cancelled = 0;  
                    $duduction = $administartor_percent;                                         
                    if($retrieve_charge->amount_refunded == 0)//if no refund in a charge
                    {
                      
                      //---------deduct cancelled appointment fine
                      $cancelledApps = CancelledAppointment::where('user_id',$app->provider_id)
                                                           ->where('status',2)
                                                           ->get();                                       
                        if( $cancelledApps->count() > 0 )//provider has cancelled appointment and fine
                        {
                            $cancelled =  $cancelledApps->count();
                            $duduction = $duduction + config::get('constants.cancelled_app_fine') * $cancelled;
                        } 
                        $destinationAmount = $retrieve_charge->amount - ($duduction / 100) * $app->service_amount;

                        $la_share_amount = $app->service_amount - $destinationAmount;
                        $administartor_percent = $duduction;
                        //---------------------------------
                    }
                    else if($retrieve_charge->amount_refunded > 0)//if refund did in a charge
                    {

                      $destinationAmount = ($retrieve_charge->amount - $retrieve_charge->amount_refunded) - ($administartor_percent / 100) * ($retrieve_charge->amount - $retrieve_charge->amount_refunded);
                      $la_share_amount = ($retrieve_charge->amount - $retrieve_charge->amount_refunded) - $destinationAmount;
                      $administartor_percent = $administartor_percent;
                    }

                    //------------------------------------------------------------------
                    
                    $lapaymenthistory = array();
                    if($destinationAmount > 0)
                    {
                    try {
                            $transferStatus = 1;
                            $message = 'paid';
                            //-----------------------------------stripe transaction section

                            $transfer = Transfer::create(array(
                              "amount" => $destinationAmount,//originale:$destinationAmount//test:1
                              "currency" => 'GBP',//original:GBP//test:USD
                              "destination" => $app->account
                            ));

                            if(isset($transfer->id))//status changed to cancelled app fine paid
                            {
                                CancelledAppointment::where('user_id',$app->provider_id)
                                                    ->where('status',2)
                                                    ->update(['status' => 1]);
                            }

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
                        Mail::send('emails.stripe_transfer_to_provider', ['name' => $app->name,'cancelled' => $cancelled,'fine' => $duduction,'mailContent' =>$transfer],function ($m) use ($app,$toMail){
                                $m->from('Info@linkaesthetics.com', 'LinkAesthetics');
                                $m->to($toMail)->subject('Payment confirmation');
                            }); 
                    }
                    //--------------------------------------------------
                } 
                //--------------------------------------loop end    
                //la payment history bulk insert
                if(!empty($lapaymenthistory))
                $insert_history = LaPaymentHistory::insert($lapaymenthistory);
            }
        })->daily();
        
        //----------------------------------------------------------------transfer end
        
        //-----------------------------------------remove not paid appointment
        $schedule->call(function()
        { 
            $remove_app =BookAppointment::where('appointment_status',2)//request accepted
                                      ->where('payment_status',2)//appointment payment not done
                                      ->select('id','created_at')->get();
                $ids = array();
                foreach($remove_app as $app)
                {
                    $date = Carbon::parse($app->created_at);
                    $now = Carbon::now();

                    $diff = $now->diffInDays($date);
                    if($diff >= 1)
                    {
                        $ids[] = $app->id;  
                    } 
                } 

                BookAppointment::whereIn('id',$ids)
                                 ->update(['appointment_status' => 6]); 
        })->everyMinute();
        //-----------------------------------------remove ad offer after ad end date
        $schedule->call(function()
        { 
            $yesterday = Carbon::yesterday();

            $yesterday = Carbon::yesterday();

            $ads = Advertisement::where('ad_status',1)->where('ad_offer',1)->whereDate('period_to','=',$yesterday)->lists('service')->toArray();
             
             if($ads != null)
             {

                DB::update(DB::raw('update provider_services set service_amount=provider_services.service_actual_amount,offer_percentage="",service_offer="2" where services_id IN('.implode(',',$ads).')'));
             }

        })->daily();
        //-----------------------------------------------------end
        
    }
}

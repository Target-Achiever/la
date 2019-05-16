<?php

namespace App;


use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Mail;
use App\User;
use App\BookAppointment;
class StatusService
{

    protected $mailer;

    protected $activationRepo;

    protected $resendAfter = 24;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
        // $this->activationRepo = $activationRepo;
    }

    public function sendStatusMail($provider_id,$admin_status,$sub,$template)
    {
        $user=User::where('id','=',$provider_id)->get();

        Mail::send($template, ['user' => $user,'admin_status' => $admin_status,'sub' => $sub] , function ($m) use ($user,$sub) {
            $m -> from('Info@linkaesthetics.com', 'Link Aesthetics');
            $m -> to($user[0]['email'], $user[0]['name'])->subject($sub);

        });

        return $user;
    }
    public function sendAppointmentMail($app_id,$admin_status,$sub,$status)
    {
        $user = BookAppointment::where('id','=',$app_id)->get();
        $subject =$sub." ".$status;
        Mail::send('emails.appointment', ['user' => $user,'admin_status' => $admin_status,'sub' => $subject] , function ($m) use ($user,$subject) {

            $m -> from('Info@linkaesthetics.com', 'Your Application');
            $m -> to($user[0]['user_email'], $user[0]['user_name'])->subject($subject);

        });

        return $user;
    }
    public function sendSubscribeMail($email,$sub,$template){

        Mail::send($template, ['email' => $email,'sub' => $sub] , function ($m) use ($email,$sub) {
            $m -> from('Info@linkaesthetics.com', 'Link Aesthetics');
            $m -> to($email)->subject($sub);

        });

        return $email;
    }
}
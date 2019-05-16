<?php

namespace App;


use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Mail;
use App\User;
use App\Notifications;
class ActivationService
{

    protected $mailer;

    protected $activationRepo;

    protected $resendAfter = 24;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
        // $this->activationRepo = $activationRepo;
    }

    public function sendActivationMail($user)
    {

        if($user->user_status != null )//existing user trying to login without mail verification
        {
            $token = $this->getToken();
            User::where('id',$user->id)
                ->update(['verification_code' => $token,'verification_code_sent_at' => date('Y-m-d H:i:s')]);
        }
        
        Mail::send('emails.welcome', ['userinfo' => $user,'token' => ($user->user_status !=null) ? $token : $user->verification_code], function ($m) use ($user) {
            $m->from('Info@linkaesthetics.com', 'LinkAesthetics');

            $m->to($user->email, $user->name)->subject('Registration');
        });

        return $user;
    }
     protected function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }  
    
    

}
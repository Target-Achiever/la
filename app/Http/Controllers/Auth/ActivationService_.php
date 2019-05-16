<?php

namespace App;


use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Mail;
use App\User;

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

    public function sendActivationMail_($user)
    {
        // if ($user->activated || !$this->shouldSend($user)) {
        //     return;
        // }
        $token = $this->getToken();

        if($user->user_status !=null )
        {
            User::where('id',$user->id)
                ->update(['verification_code' => $token,'verification_code_sent_at' => date('Y-m-d H:i:s')]);
        }

        Mail::send('emails.welcome', ['userinfo' => $user,'token' => $token], function ($m) use ($user) {
            $m->from('hello@app.com', 'Your Application');

            $m->to($user->email, $user->name)->subject('Account activation');
        });

        return $user;
    }
    protected function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    

}
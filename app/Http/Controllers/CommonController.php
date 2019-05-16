<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;



use App\Http\Requests;



use App\Notifications;



use App\User;



use Carbon\Carbon;



use Stripe\Stripe;



use Stripe\Customer;



use App\BookAppointment;



use Stripe\Charge;



use Stripe\Account;



use Stripe\Transfer;



use Stripe\Payout;



use Config;



use Stripe\Balance;

use Mail;

use Illuminate\Support\Facades\Crypt;

use App\ProviderServices;

use DB;

use Auth;

use Response;

class CommonController extends Controller

{

    //

    public static function notificationViewed($notId)

    {

    	$notify = Notifications::where('id',$notId)

                      ->update(['notify_status' => 1]);

    }

    public static function insert_notification($data)

    {

        Notifications::create([

                                    'notify_action_id' => $data['action_id'],

                                    'notify_action_type' => $data['type'],//user-provider appointment

                                    'notify_action_from' => $data['from'],

                                    'notify_action_to' => $data['to'],

                                    'notify_message' => $data['message'],

                                    'notify_status' => 2

                                ]);

    }


    public function activateUser($token)

    {

        $activation = $this->getActivationByToken($token);



        if ($activation === null) {

            

            return redirect('/')->with('success','danger|Oops! something went wrong, please try again later.');

        }



        $user = User::find($activation->id);



        $user->user_status = 'active';



        $user->verified_at = Carbon::now();



        $user->save();


        return redirect('/')->with('success','success|Your account has been activated. Please login.');



    }
	public static function sendSubscribe($user){

        echo $usermail = $user['email'];

        Mail::send('emails.active_status', ['email' => $usermail,'sub' => 'Linkaesthetics - Unlock Best Deals and Offers ','user'=>$user] , function ($m) use ($usermail) {
            $m -> from('Info@linkaesthetics.com', 'Link Aesthetics');
            $m -> to($usermail)->subject('Linkaesthetics - Unlock Best Deals and Offers');

        });

        return $usermail;
    }
    public function activateUserStatus($id){

        User::find($id)->update(['business_status'=>'1']);

        return redirect('/')->with('success','success|Success!, Deals and Offers are unlocked.');
    }
	
    public function getActivationByToken($token)

    {

        return User::where('verification_code', $token)->first();

    }

    /**

     * @param $user

     * @param $notify_message

     */

    public static function superAdminNotification($user, $notify_message,$notify_type){



        $super_admin = User::where('user_type','super_admin')->first();



        Notifications::create([

            'notify_action_id' => $user->id,

            'notify_action_type' => $notify_type,//user register

            'notify_action_from' => $user->id,

            'notify_action_to' => $super_admin->id,

            'notify_message' => $notify_message,

            'notify_status' => 2

        ]);

    }

    /*

        provider section

    */

    /*check whether the provider service has had an appointment */    

    public static function check_appointment_exist($service_id)

    {
        $service =  ProviderServices::where('provider_services_id', $service_id)->first();


        $count = BookAppointment::where('service_needed',$service->services_id)->count();


        if($count > 0)

        {

            return true;

        }

        else

        {

            return false;

        }

    }
    public function update_table()
    {
        // DB::update( DB::raw("ALTER TABLE `disclaimers` MODIFY COLUMN `type` enum('1','2','3')") );
        
        //DB::update( DB::raw("ALTER TABLE `advertisement` MODIFY COLUMN `ad_status` enum('1','2','3','4')") );
    }

    public function getDownload($file_path,$ext)
   {
       $path = asset('uploads/providers/'.$file_path);

       $file_info  = new \finfo(FILEINFO_MIME_TYPE);
       
       $type = $file_info->buffer(file_get_contents($path));

       $user = Auth::user();

       $headers = array(
                 'Content-Type: '.$type.'',
               );

       $ext = pathinfo($file_path, PATHINFO_EXTENSION);

       $filename = time().'.'.$ext;

       $download_path = base_path().'/public/uploads/providers/' . $file_path;

       return Response::download($download_path, $filename, $headers);
   }
}


<?php



namespace App\Http\Controllers\Auth;



use App\User;



use Validator;



use App\Http\Controllers\Controller;



use Illuminate\Foundation\Auth\ThrottlesLogins;



use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;



use App\ActivationService;



use Illuminate\Http\Request;



use App\User_detail;



use Auth;



use Cookie;



use App\Http\Controllers\CommonController;



// use Socialite;



use URL;



use App\MailChimp;







class AuthController extends Controller

{

    /*

    |--------------------------------------------------------------------------

    | Registration & Login Controller

    |--------------------------------------------------------------------------

    |

    | This controller handles the registration of new users, as well as the

    | authentication of existing users. By default, this controller uses

    | a simple trait to add these behaviors. Why don't you explore it?

    |

    */



    use AuthenticatesAndRegistersUsers, ThrottlesLogins;



    /**

     * Where to redirect users after login / registration.

     *

     * @var string

     */

    protected $redirectTo = '/';

    protected $activationService;



    /**

     * Create a new authentication controller instance.

     *

     * @return void

     */

    public function __construct(ActivationService $activationService)

    {

        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);

         $this->activationService = $activationService;

    }



    /**

     * Get a validator for an incoming registration request.

     *

     * @param  array  $data

     * @return \Illuminate\Contracts\Validation\Validator

     */

    protected function validator(array $data)

    {

        return Validator::make($data, [

            'name' => 'required|max:255',

            'email' => 'required|email|max:255|unique:users',

            'password' => 'required|min:6|confirmed',

        ]);





    }

    protected function login_validator(array $data)

    {

        return Validator::make($data, [

            'email' => 'required|email',

        ]);





    }



    /**

     * Create a new user instance after a valid registration.

     *

     * @param  array  $data

     * @return User

     */

    protected function create(array $data)

    {

        

         $token = $this->getToken();

         $create =  User::create([

            'name' => $data['name'],

            'email' => $data['email'],

            'password' => bcrypt($data['password']),

            'verification_code' => $token,

            'verification_code_sent_at' => date('Y-m-d H:i:s')

        ]);



         $nameSlug = str_slug($create->name.'-'.$create->id,'-');



         User::where('id',$create->id)

         ->update(['user_type' => $data['user_type'],'user_slug' => $nameSlug,'administrator_approval' => ($data['user_type'] == 'end_user') ? 1 : 2]);



         //----------------store user for mail chimp

         MailChimp::create(['user_id' => $create->id,'email' => $data['email'],'name' => $data['name'],'user_type' => ($data['user_type'] == 'end_user') ? 1 : 2

                            ]);

         //----------------------------------------



         $ip = \Request::ip();

         // $ip = '122.165.115.182';

         $locationdata = \Location::get($ip);

         $location_string = (isset($locationdata->countryCode)) ? strtolower(trim($locationdata->cityName.','.$locationdata->regionName.','.$locationdata->countryCode)): '';  

        //--------------------create user details  

         $createUserDetail =  User_detail::create([

            'user_id' => $create->id,

            'latitude' => $locationdata->latitude,

            'longitude' => $locationdata->longitude,

            'country_code' => (isset($locationdata->countryCode)) ? strtolower($locationdata->countryCode) : '',

            'state' => (isset($locationdata->regionName)) ? strtolower($locationdata->regionName) : '',

            'city' => (isset($locationdata->cityName)) ? strtolower($locationdata->cityName) : '',

            'location_string' => $location_string

        ]);

         //----------------------------------------------



        CommonController::superAdminNotification($create,'New user has been registered.','4');



        return $create;

    }

    public function redirectPath()

    {

        

        if ( Auth::check() && (Auth::user()->user_type == 'prescriber' ) || (Auth::user()->user_type == 'non_prescriber' ))

        {

            return "/provider/home";//provider dashboard

        }else if((Auth::user()->user_type == 'super_admin' ))

        {

             return "/admin/home";//admin dashboard

        }





        return "/";//return to user home

    }

    

    public function register(Request $request) {



        $validator = $this->validator($request->all());



        if ($validator->fails()) {

            

            $errors = $validator->errors();

            

            foreach ($errors->all() as $message) {

                

                $abc[] = $message;

            }

            

            $validator->getMessageBag()->add('message', $abc);

            $validator->getMessageBag()->add('status', false);

            

            return response()->json($validator->messages(), 200);

        }

    

        $user = $this->create($request->all());



        // Sending email, sms or doing anything you want

        $this->activationService->sendActivationMail($user);



        $validator->getMessageBag()->add('message', 'We have sent a confirmation link to your email, please click the link to activate your account');

        $validator->getMessageBag()->add('status',true);



        return response()->json($validator->messages(), 200);

    }

    protected function getToken()

    {

        return hash_hmac('sha256', str_random(40), config('app.key'));

    }

    public function custom_login(Request $request)

    {

            $validator = $this->login_validator($request->only('email'));

            if ($validator->fails()) {

            

                $errors = $validator->errors();



                if ($errors->has('email')) {

                    

                    $message = $errors->get('email');

                }

                return response()->json([

                    'auth' => false,

                    'intended' => $message

                ]);

            }

            //----------------------------------------------------------------

            $auth = false;

            $credentials = $request->only('email', 'password');



            $intended = '/';



            if ($check = Auth::attempt($credentials, $request->has('remember')))//autentication true 

            {

                $auth = true; // Success



                 $intended = (Auth::user()->user_type == 'admin') ? '/admin/home' : ((Auth::user()->user_type == 'prescriber' || Auth::user()->user_type == 'non_prescriber')) ? '/provider/home' : '/';





                 $user = Auth::user();



                 //-------------------------------------------------------------------------if account not activated

                 if ($user->user_status != 'active' && $user->verified_at == null) {

                    $this->activationService->sendActivationMail($user);

                    auth()->logout();



                    $return['intended'] = 'You need to confirm your account. We have sent you an activation code, please check your email.';

                    $return['auth'] = false;



                    return response()->json($return);

                    

                }

                else if($user->user_status == 'in_active')//if account deactivated by admin

                {

                    auth()->logout();



                    $return['intended'] = 'Oops! Your account has been deactivated by Linkaesthetics administrator.';

                    $return['auth'] = false;



                    return response()->json($return);

                    

                }

                //------------------------------------------------------------------------



                    User_detail::where('user_id',$user->id)

                    ->increment('loginCount', 1,['lastLogin'=> date('Y-m-d H:i:s')]);

            }

            else

            {

                $intended = 'Invalid user email/password';

            }



           



            if ($request->ajax()) {

                return response()->json([

                    'auth' => $auth,

                    'intended' => $intended

                ]);

            } else {

                return redirect()->intended(URL::route('/'));

            }

            return redirect(URL::route('/'));

    }

    public function authenticated(Request $request, $user)

    {

                

        if ($user->user_status != 'active' && $user->verified_at == null) {

            $this->activationService->sendActivationMail($user);

            auth()->logout();

            return back()->with('success', 'success|You need to confirm your account. We have sent you an activation code, please check your email.');

        }

        else if($user->user_status == 'in_active')

        {

            auth()->logout();

            return back()->with('success', 'warning|Oops! Your account has been in-activated by app admin');   

        }

        //----------------------------------------------set cookie

        // Cookie::queue('user_email',$user->email,60);

        //------------------------------update logincount

        

        User_detail::where('user_id',$user->id)

                        ->increment('loginCount', 1,['lastLogin'=> date('Y-m-d H:i:s')]);



        $return['intended'] = $this->redirectPath();

        $return['auth'] = true;



        return response()->json($return);

    }

    // -------fb login



    /**

     * Redirect the user to the OAuth Provider.

     *

     * @return Response

     */

    public function redirectToProvider($provider)

    {

        return Socialite::driver($provider)->redirect();

    }



    /**

     * Obtain the user information from provider.  Check if the user already exists in our

     * database by looking up their provider_id in the database.

     * If the user exists, log them in. Otherwise, create a new user then log them in. After that 

     * redirect them to the authenticated users homepage.

     *

     * @return Response

     */

    public function handleProviderCallback($provider)

    {

        $user = Socialite::driver($provider)->user();



        $authUser = $this->findOrCreateUser($user, $provider);

        Auth::login($authUser, true);

        return redirect($this->redirectTo);

    }

    /**

     * If a user has registered before using social auth, return the user

     * else, create a new user object.

     * @param  $user Socialite user object

     * @param $provider Social auth provider

     * @return  User

     */

    public function findOrCreateUser($user, $provider)

    {

        $authUser = User::where('social_login_id', $user->id)->first();

        

        if ($authUser) {

            

            return $authUser;

        }



        $create = User::create([

            'name'     => $user->name,

            'email'    => $user->email,

            'photo'    => $user->avatar,

            'social_login_type' => 'facebook',

            'social_login_id'   => $user->id,

            'administrator_approval' => 1

        ]);



        $nameSlug = str_slug($user->name.'-'.$create->id,'-');



        User::where('id',$create->id)

              ->update(['user_slug' => $nameSlug,'user_status' => 'active']);

        //---------------------create user details table

         // $ip = \Request::ip();

         $ip = '122.165.115.182';

         $locationdata = \Location::get($ip);

         $location_string = (isset($locationdata->countryCode)) ? strtolower(trim($locationdata->cityName.','.$locationdata->regionName.','.$locationdata->countryCode)): '';  

        //--------------------create user details  

         $createUserDetail =  User_detail::create([

            'user_id' => $create->id,

            'latitude' => $locationdata->latitude,

            'longitude' => $locationdata->longitude,

            'country_code' => (isset($locationdata->countryCode)) ? strtolower($locationdata->countryCode) : '',

            'state' => (isset($locationdata->regionName)) ? strtolower($locationdata->regionName) : '',

            'city' => (isset($locationdata->cityName)) ? strtolower($locationdata->cityName) : '',

            'location_string' => $location_string,

            'social_login_response' => json_encode($user)

        ]);

        //----------------------------------------------



         return $create;

    }

}


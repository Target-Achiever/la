<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

use App\User_answer;
class ProviderAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    { 
    
        if ( Auth::check() && (Auth::user()->user_type == 'prescriber' || Auth::user()->user_type == 'non_prescriber') )
        {
            if (\Request::is('provider/become-a-provider') || \Request::is('provider/save_become_a_provider')) 
                { 
                  
                }else
                {
                        $userid = Auth::user()->id;

                        $sAdminApprovalStatus = Auth::user()->administrator_approval;
                    
                        $profilecomplterStatus = User_answer::where('user_id',$userid)->count();
                        
                        if($profilecomplterStatus == 0 || ($sAdminApprovalStatus == 2 || $sAdminApprovalStatus == 3))
                        {
                            if($profilecomplterStatus == 0)
                            {
                                $message = "Please submit the form to access your dashboard.";
                            }else if($sAdminApprovalStatus == 2)
                            {
                                $message = "You account approval is under process.";
                            }else if($sAdminApprovalStatus == 3)
                            {
                                $message = "You account has been rejected by admin. Please resubmit the clear data.";
                            }
                            
                            return redirect('provider/become-a-provider')->with('update-profile',$message);
                        }
                }
            

            return $next($request);

        }else{

            return redirect ('/');

        }
        
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

use Auth;


class CheckUserLogin
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
         
        $response = $next($request);
        if(Auth::check())
        {
            if(session('app_id')!=null)
            {
                return redirect('/book-an-appointment/'.$request->session()->pull('app_id'));
        
            }
        }

        //----------------------------------------
        if(Auth::check())
        {
            if((Auth::user()->user_type != 'end_user' ) && ( (Auth::user()->user_type == 'prescriber' ) || Auth::user()->user_type == 'non_prescriber') )
                {
                    
                    return redirect('/provider/home');
                }
                else if((Auth::user()->user_type != 'end_user' ) && (Auth::user()->user_type == 'super_admin' ))
                {
                    return redirect('/admin/home');
                }
        }
        //------------------------------------------
        return $response; 
        
    }
}

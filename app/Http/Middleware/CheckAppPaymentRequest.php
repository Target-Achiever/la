<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

use App\BookAppointment;

class CheckAppPaymentRequest
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
        if(Auth::check())
        {
            
            $user_id = Auth::user()->id;

            $app_id = $request->route('appointmentid');

            $appointment_id = \Crypt::decrypt($app_id);

            $getappid = explode('-',$appointment_id);

            $getappid = end($getappid);

            $app = BookAppointment::where('id',$getappid)->first();

            $validateApp = BookAppointment::where('id',$getappid)->count();

            if($validateApp == 0)
            {
                return redirect()->back()->with('actionDone','Invalid user/payment request');
            }

        }else
        {
            return redirect('/');
        }

        return $next($request);
    }
}

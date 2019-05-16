<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

use App\Advertisement;

class CheckAdPaymentRequest
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

            $ad_id = $request->route('advertisementid');

            $advertisement_id = \Crypt::decrypt($ad_id);

            $getadid = explode('-',$advertisement_id);

            $getadid = end($getadid);

            $validateAd = Advertisement::where('id',$getadid)
                                        ->where('user_id',$user_id)->count();


            if($validateAd == 0)
            {
                return redirect()->back()->with('success','danger|Invalid user/payment request');
            }

        }else
        {
            return redirect('/');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Profile;

class isLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has('user') && $request->session()->get('user')['isAdmin'] == 0 ){
            $user = Profile::where('user_name',session()->get('user')['userName'])->first();
            if(isset($user->image)){
                session()->put('user.image',$user->image);
            }
            return $next($request);
         }else{
             return redirect('/login');
         }
    }
}

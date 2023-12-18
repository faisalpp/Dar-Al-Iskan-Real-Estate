<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\User;
use App\Models\Profile;
use App\Models\Transaction;
use App\Models\Account;
use App\Models\Gateway;
use App\Models\MasterPlan;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserAuth extends Controller
{

    // Register View
    public function RegisterView(){
        $gateways = Gateway::get();
        return view('register',compact('gateways'));
    }

    public function Register(Request $request){
        $request->validate([
            'full_name'=>'required',
            'user_name'=>'required|unique:users',
            'email'=>'required|unique:users',
            'phone'=>'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);
        try{
        // Create User
        $user = new User();
        $user->full_name = $request['full_name'];
        $user->user_name = $request['user_name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        if(isset($request['ref_by'])){
          $user->ref_by = $request['ref_by'];
        }
        $user->save();
        if($user){
        // Create User Profile
        $profile = new Profile();
        $profile->phone = $request['phone'];
        $profile->full_name = $request['full_name'];
        $profile->user_name = $request['user_name'];
        $profile->save();
        }
        if($profile){
            // Create User account
            $account = new Account();
            $account->user_name = $request['user_name'];
            $account->save();
        }
        session()->flash('success','Account Successfully Created!');
        return redirect('/login');
    }catch(Exception $e){
        return abort(500);
    }
    
    }

    public function RefRegisterView($refBy){
       $plans = Plan::get();
       return view('register')->with(compact('refBy','refBy','plans','plans'));
    }

    // Login Request
    public function Login(Request $request){
        $request->validate([
          'email'=>'required',
          'password'=>'required'
        ]);

        $getUser = User::where('email',$request['email'])->with('Profile')->first();
        if($getUser){
            $pass = Hash::check($request['password'],$getUser->password);
           if($pass){ 
            if(isset($getUser->profile->image)){
                $user = [
                    'userId'=>$getUser->user_id,
                    'userName'=>$getUser->user_name,
                    'image'=>$getUser->profile->image,
                    'isAdmin'=>$getUser->is_admin,
                    'isBlocked'=>$getUser->is_blocked
                ];
            }else{
                $user = [
                    'userId'=>$getUser->user_id,
                    'userName'=>$getUser->user_name,
                    'image'=>null,
                    'isAdmin'=>$getUser->is_admin,
                    'isBlocked'=>$getUser->is_blocked
                ];
            }

            $request->session()->put('user',$user);
            if($getUser->is_admin == 1){
                return redirect('/admin/dashboard');
            }else{
                return redirect('/user/dashboard');
            }
           }else{
               session()->flash('error','Invalid Credentials!');
               return redirect()->back();
           }
        }else{
            session()->flash('error','Invalid Credentials!');
            return redirect()->back();
        }


    }

    public function Logout(Request $request){
        $request->session()->remove('user');
        return redirect('/');
    }

    public function ChangePassword(Request $request){
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);

        $new_pass = Hash::make($request['password']);
        try{
            User::where('user_name',session()->get('user')['userName'])->update(['password'=>$new_pass]);
        }catch(Exception $e){
            return abort(500);
        }
        session()->flash('success',"Password Changed!");
        return redirect()->back();
    }
}

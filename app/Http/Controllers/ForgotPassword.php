<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Facades\URL;

class ForgotPassword extends Controller
{
    public function submitForgotPassword(Request $request){
        $request->validate([
          'email'=>'required|email|exists:users',
        ]);
  
        $token = rand(1,100000);
        $save_token = new PasswordReset();
        $save_token->email = $request->email;
        $save_token->token = $token;
        $save_token->save();
        $url = URL::temporarySignedRoute(
          "reset-password", now()->addMinutes(180), ['token' => $token]
          );
        $data = array('url'=>$url,'email'=>$request->email);
        Mail::send('mailsView.forgotPassword', $data, function($message) use ($data) {
           $message->to($data['email'])->subject('HYIEP PassworHIYEP Reset!');
           $message->from('muhammadfaisal522@gmail.com','');
        });
        session()->flash('success',"We'v send you Email to Reset Password!");
        return redirect('/login');
      }

      public function resetPasswordView(Request $request,$token){
        if (!$request->hasValidSignature()) {
          abort(403);
        }
        return view('reset-password')->with('token',$token);
      }

      public function submitResetPassword(Request $request){
        $request->validate([
        'email'=>'required|email|exists:users',
        'password'=>'required|string|confirmed',
        'password_confirmation'=>'required',
       ]);
  
       try{
         $updatePass = PasswordReset::where('email',$request->email)->where('token',$request->token)->first();
        }catch(\Exception $e){
          abort(500);
        }
          $password = Hash::make($request->password);
          $user = User::where('email',$request->email)->update([
            'password'=> $password
          ]);  
          PasswordReset::where('email',$request->email)->delete();
          session()->flash('success','Your Password has been Reset!');
          return redirect('/login');
        }
}

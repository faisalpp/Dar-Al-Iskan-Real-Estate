<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDashboard;
use App\Http\Controllers\AdminViews;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\ForgotPassword;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\Account;
use App\Models\User;
use App\Models\Plan;
use App\Models\Gateway;
use App\Models\MasterPlan;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/','login');
Route::view('/about','about');
Route::view('/contact','contact');
Route::view('/privacy','policy');
Route::view('/terms','terms');
Route::get('/register',[UserAuth::class,'RegisterView']);
// Auth APi's
Route::post('/login',[UserAuth::class,'Login']);
Route::post('/register',[UserAuth::class,'Register']);
Route::get('/logout',[UserAuth::class,'Logout']);


// Forgot Password Views Routes
Route::view('/forgot-password','forgot-password');
Route::view('/reset-password','reset-password');

// Password Reset Related Routes
Route::post('/forgot-password',[ForgotPassword::class,'submitForgotPassword']);
Route::get('/reset-password/{token}/reset-password',[ForgotPassword::class,'resetPasswordView'])->name('reset-password')->middleware('signed');
Route::post('/reset-password',[ForgotPassword::class,'submitResetPassword']);


// Admin Dashboard Routes
Route::group(['middleware'=>['isAdmin']],function(){
 Route::get('/admin/dashboard',[AdminViews::class,'Dashboard']);
 
 Route::get('/admin/manage-listings',[AdminViews::class,'ManageListings']);
 Route::get('/admin/add-listing',[AdminViews::class,'AddListing']);
 
 Route::get('/admin/manage-clients',[AdminViews::class,'ManageClients']);
 Route::get('/admin/add-client',[AdminViews::class,'AddClient']);

 Route::get('/admin/manage-appointments',[AdminViews::class,'ManageAppointments']);
 Route::get('/admin/create-client',[AdminViews::class,'CreateClient']);
 
 Route::get('/admin/change-password',[AdminViews::class,'ChangePassword']);


// api's
// Route::post('/admin/change-password',[AdminProfileController::class,'ChangePassword']);
});





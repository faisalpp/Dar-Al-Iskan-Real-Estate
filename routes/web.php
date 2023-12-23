<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminViews;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\ForgotPassword;

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
Route::get('/register',[AdminController::class,'RegisterView']);
// Auth APi's
Route::post('/login',[AdminController::class,'Login']);
Route::post('/register',[AdminController::class,'Register']);
Route::get('/logout',[AdminController::class,'Logout']);


// Forgot Password Views Routes
Route::view('/forgot-password','forgot-password');
Route::view('/reset-password','reset-password');

// Password Reset Related Routes
Route::post('/forgot-password',[ForgotPassword::class,'submitForgotPassword']);
Route::get('/reset-password/{token}/reset-password',[ForgotPassword::class,'resetPasswordView'])->name('reset-password')->middleware('signed');
Route::post('/reset-password',[ForgotPassword::class,'submitResetPassword']);

Route::middleware(['isLogin'])->group(function () {
// Admin Dashboard Routes
 Route::get('/admin/dashboard',[AdminViews::class,'Dashboard']);
 
//  Listing Routes
 Route::get('/admin/manage-listings',[AdminViews::class,'ManageListings']);
 Route::get('/admin/view-listing/{id}',[AdminViews::class,'ViewListing']);
 Route::get('/admin/add-listing',[AdminViews::class,'AddListing']);
 Route::post('/admin/create-listing',[ListingController::class,'CreateListing']);
 Route::post('/admin/update-listing',[ListingController::class,'UpdateListing']);
 Route::post('/admin/delete-listing',[ListingController::class,'DeleteListing']);

//  Client Routes
 Route::get('/admin/manage-clients',[AdminViews::class,'ManageClients']);
 Route::get('/admin/add-client',[AdminViews::class,'AddClient']);
 Route::post('/admin/create-client',[ClientController::class,'CreateClient']);
 Route::get('/admin/view-client/{id}',[AdminViews::class,'ViewClient']);
 Route::post('/admin/update-client',[ClientController::class,'UpdateClient']);
 Route::post('/admin/delete-client',[ClientController::class,'DeleteClient']);
 Route::post('/admin/get-clients',[ClientController::class,'GetClients']);
 
// Media Routes
Route::post('/admin/upload-media',[MediaController::class,'UploadMedia']);


//  Appointment Routes
 Route::get('/admin/manage-appointments',[AdminViews::class,'ManageAppointments']);
//  Route::get('/admin/create-client',[AdminViews::class,'CreateClient']);
 
 Route::get('/admin/change-password',[AdminViews::class,'ChangePassword']);
});

// api's
// Route::post('/admin/change-password',[AdminProfileController::class,'ChangePassword']);





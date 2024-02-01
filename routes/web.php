<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminViews;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\CalanderController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PdfController;
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
Route::middleware(['localization'])->group(function () {

 Route::post('/change-language',[LanguageController::class,'ChangeLanguage']);
 Route::view('/','login');
 Route::get('/register',[AdminController::class,'RegisterView']);
 // Auth APi's
 Route::post('/login',[AdminController::class,'Login']);
 Route::post('/register',[AdminController::class,'Register']);
 Route::get('/logout',[AdminController::class,'Logout']);

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
  
  //   Manage Users
  Route::middleware(['isSuperAdmin'])->group(function () {
    Route::get('/admin/manage-users',[AdminViews::class,'ManageUsers']);
    Route::get('/admin/add-user',[AdminViews::class,'AddUser']);
    Route::post('/admin/create-user',[UserController::class,'CreateUser']);
    Route::post('/admin/update-user',[UserController::class,'UpdateUser']);
    Route::post('/admin/delete-user',[UserController::class,'DeleteUser']);
    Route::post('/admin/ban-user',[UserController::class,'BanUser']);
    Route::post('/admin/unban-user',[UserController::class,'UnBanUser']);
  });

  // Media Routes
  Route::post('/admin/upload-media',[MediaController::class,'UploadMedia']);
  Route::post('/admin/delete-media',[MediaController::class,'DeleteMedia']);

  //  Appointment Routes
  Route::get('/admin/manage-appointments',[AdminViews::class,'ManageAppointments']);
  Route::post('/admin/create-event',[CalanderController::class,'CreateEvent']);
  Route::post('/admin/update-event',[CalanderController::class,'UpdateEvent']);
  Route::post('/admin/delete-event',[CalanderController::class,'DeleteEvent']);

  Route::get('/admin/change-password',[AdminViews::class,'ChangePassword']);
  Route::post('/admin/change-password',[ForgotPassword::class,'ChangePassword']);

  //  Pdf Docuement Export Api's
  Route::post('/admin/export-listings-pdf',[PdfController::class,'ExportListings']);
  Route::post('/admin/export-clients-pdf',[PdfController::class,'ExportClients']);
  Route::get('/admin/export-listing-pdf/{id}',[PdfController::class,'ExportListing']);
 });

});

Route::get('/download-calender',[CalanderController::class,'GenerateEvents']);





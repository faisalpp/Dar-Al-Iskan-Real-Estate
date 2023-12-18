<?php

namespace App\Http\Controllers;

class AdminViews extends Controller
{
  public function Dashboard(){
      return view('adminDashboard.index');
  }

  public function ManageListings(){
      // $master_plan = MasterPlan::first();
      return view('adminDashboard.ManageListing');
  }
  
  public function AddListing(){
      // $master_plan = MasterPlan::first();
      return view('adminDashboard.AddListing');
  }
  
  public function ManageClients(){
      // $master_plan = MasterPlan::first();
      return view('adminDashboard.ManageClient');
  }
  
  public function AddClient(){
      // $master_plan = MasterPlan::first();
      return view('adminDashboard.AddClient');
  }

  public function ManageAppointments(){
      // $master_plan = MasterPlan::first();
      $events = [
        [
            'title' => 'Fake Event 1',
            'start' => '2023-12-01T10:00:00',
            'end' => '2023-12-01T12:00:00',
        ],
        [
            'title' => 'Fake Event 2',
            'start' => '2023-12-15T14:00:00',
            'end' => '2023-12-15T16:00:00',
        ],
      ];
      return view('adminDashboard.ManageAppointment',compact('events'));
  }
  
  public function CreateAppointment(){
      // $master_plan = MasterPlan::first();
      return view('adminDashboard.CreateAppointment');
  }
  
  public function ChangePassword(){
    return view('adminDashboard.change-password');
  }

}

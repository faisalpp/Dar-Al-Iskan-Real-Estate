<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Listing;
use Illuminate\Http\Request;

class AdminViews extends Controller
{
  public function Dashboard(){
      return view('adminDashboard.index');
  }

  public function ManageListings(Request $request){

    $search = $request['search'] ?? '';
    $filter = $request['filter'];

    
    if($search !== ''){

      if($request['search'] === 'title'){
       try{
        $listings = Listing::where($filter, 'LIKE', '%' . $search . '%')->paginate(20);
       }catch(error){
        return abort(500);
       }
      }else{
       try{
        $listings = Listing::where($filter, '=',$search)->paginate(20);
       }catch(error){
        return abort(500);
       }
      }
    }else{   
     try{
      $listings = Listing::paginate(20);
     }catch(error){
      return abort(500);
     }
    }
      return view('adminDashboard.ManageListing',compact('listings','search'));
  }
  
  public function AddListing(){
      return view('adminDashboard.AddListing');
  }

  public function ViewListing(Request $request){
    try{
      $listing = Listing::where('id', $request['id'])->first();
      return view('adminDashboard.ViewListingDetail',compact('listing'));
    }catch(error){
      return abrot(500);
    }
  }
  
  public function ManageClients(Request $request){
   
    $search = $request['search'] ?? '';
    $filter = $request['filter'];

    if($filter === 'yes' || $filter === 'no'){
      try{
        $clients = Client::where('is_vip',$filter)->paginate(20);
       }catch(error){
         return abort(500);
       }
    }else{
     if($search !== ''){
       try{
         $clients = Client::where($filter,$search)->paginate(20);
        }catch(error){
          return abort(500);
        }
     }else{
      try{
       $clients = Client::paginate(20);
      }catch(error){
       return abort(500);
      }
     }
    }
    return view('adminDashboard.ManageClient',compact('clients','search'));
  }
  
  public function AddClient(){
      return view('adminDashboard.AddClient');
  }
  
  public function ViewClient(Request $request){
    $client = Client::where('id',$request['id'])->first();
    $listings = Listing::where('id',10)->get();
    return view('adminDashboard.ViewClientDetail',compact('client','listings'));
  }

  public function ManageAppointments(){
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
      return view('adminDashboard.CreateAppointment');
  }
  
  public function ChangePassword(){
    return view('adminDashboard.change-password');
  }

}

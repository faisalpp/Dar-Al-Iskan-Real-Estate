<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Charts\Statistics;
use App\Charts\PieStatistics;
use App\Models\Listing;
use App\Models\Events;
use Illuminate\Http\Request;

class AdminViews extends Controller
{
  public function Dashboard(){

    $today = Listing::whereMonth('created_at',today())->count();
    $yesterday = Listing::whereDate('created_at', today()->subDays(1))->count();
  
    $stat = new Statistics;
    $stat->labels(['Today','Yesterday']);
    $stat->dataset('Day Chart','line',[$today,$yesterday])->backgroundColor('#B2E2FF')->color('#7FCEFF');
    
    $sold = Listing::where('status','Sold')->count();
    $sell = Listing::where('status','On Sell')->count();
    
    $stat2 = new PieStatistics;
    $stat2->labels(['Sold','On Sell']);
    $stat2->dataset('Sell Analytics','pie',[$sold,$sell])->backgroundColor(collect(['#7d5fff','#32ff7e']))->color('#7158e2');


    try{
      // $total_clients = Client::count();
      $total_vip_clients = Client::where('is_vip','yes')->count();
      $total_org_clients = Client::where('is_vip','no')->count();
      $total_onsell_listings = Listing::where('status','On Sell')->count();
      $total_sold_listings = Listing::where('status','Sold')->count();
      $latest_listings = Listing::limit(4)->get();
      $latest_clients = Client::limit(4)->get();
      return view('adminDashboard.index',compact('stat2','stat','total_sold_listings','total_onsell_listings','latest_listings','latest_clients','total_vip_clients','total_org_clients'));
    }catch(error){
      return abort(500);
    }
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
      $full_name = 'Guest';
      if($listing->client !== 'Guest'){
        $client = Client::where('id', $listing->client)->first();
        $full_name = $client->first_name . ' ' . $client->middle_name . ' ' . $client->last_name;
      }
      return view('adminDashboard.ViewListingDetail',compact('listing','full_name'));
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
   
    try{
      $events = Events::get();
      return view('adminDashboard.ManageAppointment',compact('events'));
    }catch(error){
      return abort(500);
    }
  }
  
  public function CreateAppointment(){
      return view('adminDashboard.CreateAppointment');
  }
  
  public function ChangePassword(){
    return view('adminDashboard.change-password');
  }

}

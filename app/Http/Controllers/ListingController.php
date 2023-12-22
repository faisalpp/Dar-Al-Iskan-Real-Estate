<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class ListingController extends Controller
{
    public function CreateListing(Request $request){
      
     $request->validate([
        'serial_no'=>'required',
        'amount'=>'required',
        'status'=>'required',
        'title'=>'required',
        'size'=>'required',
        'type'=>'required',
        'no_bedrooms'=>'required',
        'no_toilets'=>'required',
        'no_majlis'=>'required',
        'no_floors'=>'required',
        'no_kitchens'=>'required',
     ]);

     try{
       $listing = new Listing();
       $listing->serial_no = $request['serial_no'];
       $listing->title = $request['title'];
       $listing->size = $request['size'];
       $listing->location = $request['location'];
       $listing->type = $request['type'];
       $listing->amount = $request['amount'];
       $listing->status = $request['status'];
       $listing->no_bedrooms = $request['no_bedrooms'];
       $listing->no_toilets = $request['no_toilets'];
       $listing->no_majlis = $request['no_majlis'];
       $listing->no_floors = $request['no_floors'];
       $listing->no_kitchens = $request['no_kitchens'];
       $listing->media = $request['media'];
       $listing->save();
       session()->flash('success','Listing Successfully Created!');
       return redirect('/admin/manage-listings');
     }catch(error){
        return abort(500);
     }

    }

    public function UpdateListing(Request $request){
      
     $request->validate([
        'id'=>'required',
        'serial_no'=>'required',
        'title'=>'required',
        'size'=>'required',
        'amount'=>'required',
        'status'=>'required',
        'type'=>'required',
        'no_bedrooms'=>'required',
        'no_toilets'=>'required',
        'no_majlis'=>'required',
        'no_floors'=>'required',
        'no_kitchens'=>'required',
     ]);

     try{

      Listing::where('id',$request['id'])->update([
         'serial_no' => $request['serial_no'],
         'title' => $request['title'],
         'size' => $request['size'],
         'location' => $request['location'],
         'type' => $request['type'],
         'amount' => $request['amount'],
         'status' => $request['status'],
         'no_bedrooms' => $request['no_bedrooms'],
         'no_toilets' => $request['no_toilets'],
         'no_majlis' => $request['no_majlis'],
         'no_floors' => $request['no_floors'],
         'no_kitchens' => $request['no_kitchens'],
         'media' => $request['media']
       ]);
       session()->flash('success','Listing Successfully Updated!');
       return redirect('/admin/manage-listings');
     }catch(error){
        return abort(500);
     }

    }


    public function DeleteListing(Request $request){
      $request->validate([
         'id'=>'required'
      ]);

      try{
       Listing::where('id',$request['id'])->delete();
       session()->flash('success','Listing Successfully Deleted!');
   return redirect('/admin/manage-listings');
      }catch(error){
         return abort(500);
      }

    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class ListingController extends Controller
{
    public function CreateListing(Request $request){
      
     $request->validate([
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
       $listing->title = $request['title'];
       $listing->size = $request['size'];
       $listing->location = $request['location'];
       $listing->type = $request['type'];
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

      Listing::where('id',$request['id'])->update([
         'title' => $request['title'],
         'size' => $request['size'],
         'location' => $request['location'],
         'type' => $request['type'],
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
}

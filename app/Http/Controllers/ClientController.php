<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function CreateClient(Request $request) {
     $request->validate([
        'first_name'=>'required',
        'middle_name'=>'required',
        'last_name'=>'required',
        'phone'=>'required',
        'address'=>'required',
        'email'=>'required',
        'is_vip'=>'required',
     ]);

    try{
    $client = new Client();
    $client->first_name = $request['first_name'];
    $client->middle_name = $request['middle_name'];
    $client->last_name = $request['last_name'];
    $client->phone = $request['phone'];
    $client->address = $request['address'];
    $client->email = $request['email'];
    $client->is_vip = $request['is_vip'];
    $client->save();
    session()->flash('success','Client Successfully Created!');
    return redirect()->back();
    }catch(Exception $e){
        return abort(500);
    }

  }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function UploadMedia(Request $request){
    //  $file = $request->file('file');
    //  print_r($file);
    $imageName = time().'.'.$request->file('file')->extension();
    $storagePath = base_path() . '\\public\\uploads\\';
    $path = base_path() . '\\public\\uploads\\' . $imageName;
    $request->file('file')->move($storagePath, $imageName);
     return response()->json(['path' => $path]);
    //  // Move the uploaded file to the public directory
    }
}

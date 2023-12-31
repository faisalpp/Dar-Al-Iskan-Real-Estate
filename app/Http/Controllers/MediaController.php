<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\File; 

use File;

class MediaController extends Controller
{
    public function UploadMedia(Request $request){
    //  $file = $request->file('file');
    //  print_r($file);
    $imageName = time().'.'.$request->file('file')->extension();
    $storagePath = base_path() . '\\public\\uploads\\';
    // $path = base_path() . '\\public\\uploads\\' . $imageName;
    $request->file('file')->move($storagePath, $imageName);
     return response()->json(['path' => $imageName]);
    //  // Move the uploaded file to the public directory
    }
    
    public function DeleteMedia(Request $request){

    // Construct the full path to the file
    $filePath = '\\uploads\\' . $request['name'];

    if( File::exists(public_path($filePath)) ) {
      $l =  File::delete(public_path($filePath));
        return response()->json(['message' => 'File Deleted']);
    } else {
        return response()->json(['error' => 'File Not Found!'], 404);
    }
  }
    
}

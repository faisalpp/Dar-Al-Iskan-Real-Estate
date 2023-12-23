<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function UploadMedia(Request $request){
     $file = $request->file('file');
     // Move the uploaded file to the public directory
     $path = $file->store('public/uploads');
     return response()->json(['path' => $path]);
    }
}

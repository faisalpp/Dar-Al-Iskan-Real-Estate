<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function ChangeLanguage(Request $request){
      $language = $request['language'];
      $request->session()->put('language',$language);
      return redirect()->back();
    }
}

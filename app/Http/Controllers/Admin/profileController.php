<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class profileController extends Controller
{
   public function dashboard()
   {
      $data=[
         'title'=>'Dashboard'
      ];
    return view('admin.auth.dashboard',$data);
   }

   public function logout()
    {
     auth()->logout();
     return redirect()->route('getLogin')->with('success','You have been successfully logged out'); 
   }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function home(){
    return view('home.home');
   }

   public function createuser(){
      return view('home.createuser');
     }
}

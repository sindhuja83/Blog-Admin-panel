<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Auth; // Replace with the actual namespace and trait name

class AuthController extends Controller
{
    public function getLogin(){
        return view('admin.auth.login'); 
    }


    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (auth('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication successful
            return redirect()->route('dashboard')->with('success', 'Login Successful');
        } else {
            // Authentication failed
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }
    
    
}

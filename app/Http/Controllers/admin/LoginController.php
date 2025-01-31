<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function index(){
        return view('admin.login');
    }
       
      // admin authenticate
    public function authenticate(Request $request) {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if ($validation->passes()) {
                if(Auth::guard('admin')->attempt(['email' => $request->email,'password' => $request->password,])){
                    if(Auth::guard('admin')->user()->role != "admin"){
                        Auth::guard('admin')->logout();
                        return redirect()->route('admin.login')->with('error','you are not login in admin.');
                    }
                    return redirect()->route('admin.dashboard');
                }else {
                    return redirect()->route('admin.login')->with('error','Either email or password is incorrect.');

                }

            // Proceed with authentication logic (e.g., checking credentials)
        } else {
            return redirect()->route('admin.login')
                ->withInput()
                ->withErrors($validation);
        }
    }

    
    
            public function logout(Request $request)
            {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('admin.login');
            }
        
}

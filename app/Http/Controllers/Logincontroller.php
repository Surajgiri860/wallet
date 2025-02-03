<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class Logincontroller extends Controller
{
    //this method will show login page for customer

    public function index(){
        //die('index function');
        return view ('login');
    }

    //this method will authenticate user

    public function authenticate(Request $request) {
       // die('authenticate');
        $validation = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
            
        ]);
    
        if ($validation->passes()) {
                if(Auth::attempt(['email' => $request->email,'password' => $request->password,])){
                    return redirect()->route('account.dashboard');
                }else {
                    return redirect()->route('account.login')->with('error','Either email or password is incorrect.');

                }

            // Proceed with authentication logic (e.g., checking credentials)
        } else {
            return redirect()->route('account.login')
                ->withInput()
                ->withErrors($validation);
        }
    }

    //this page are showing register
    
    public function register(){
    //    echo "tst"; die;
        return view('register');
    }

    public function processRegister(Request $request)
        {
            $validation = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed|min:8',
            ]);

            if ($validation->passes()) {
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->role = 'customer';
                $user->save();

                return redirect()->route('account.login')->with('success', 'You have registered successfully.');
            } else {
                return redirect()->route('account.register')
                    ->withInput()
                    ->withErrors($validation);
            }
        }
    public function logout(){
        Auth::logout();

        return view ('welcome');
       // return redirect()->route('/');
    }
    
}

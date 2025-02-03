<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class LoginController extends Controller
{
    //this method will show login page for customer

    public function index(){
        //die('index function');
        return view ('login');
    }

    //this method will authenticate user

    public function authenticate(Request $request) {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);
    
        if ($validation->fails()) {
            return redirect()->route('account.login')
                ->withInput()
                ->withErrors($validation);
        }
    
        // यूज़र को ईमेल के आधार पर खोजें
        $user = User::where('email', $request->email)->first();
    
        // अगर यूज़र "blocked" है, तो वॉर्निंग मैसेज दिखाएं
        if ($user->status === 'blocked') {
            return redirect()->route('account.login')->with('error', 'Your account is blocked. Please contact support.');
        }
    
        // अगर अकाउंट ब्लॉक नहीं है, तो लॉगिन ट्राई करें
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('account.dashboard');
        } else {
            return redirect()->route('account.login')->with('error', 'Either email or password is incorrect.');
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

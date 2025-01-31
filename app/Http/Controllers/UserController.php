<?php

namespace App\Http\Controllers; // ✅ Ensure this is at the top

use Illuminate\Http\Request;
use App\Models\User;  // ✅ User Model Import Karein
use App\Http\Controllers\Controller; // ✅ Controller Import Karein

class UserController extends Controller
{
    public function dashboard()
{
    // Get the current authenticated user
    $user = auth()->user(); // This assumes you are using Laravel's built-in authentication.

    // Pass the user to the view
    return view('dashboard', compact('user'));
}
}

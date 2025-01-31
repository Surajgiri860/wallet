<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Wallet;
use App\Models\WalletTransactions;
use Illuminate\Support\Facades\DB;
use App\Models\RequestTransaction; // Import the model
use App\Models\User;



class DashboardController extends Controller
{
    // Dashboard page for customer
    public function index()
    {
        return redirect('dashboard');
    }

            public function deposit()
        {
            $user = Auth::user(); // Current authenticated user

            // Agar user null hai
            if ($user === null) {
                $view = "Templates.Welcome";
                return view('Front', compact('view'));
            }

            // Fetch user wallet and requests
            $wallet = Wallet::where('user_id', $user->id)->first();
            $requests = DB::table('Request_transaction')
                ->where('user_id', $user->id)
                ->get(); // Fetch user's deposit requests

            $view = 'Templates.deposit';
            return view('deposit', compact('view', 'user', 'wallet', 'requests'));
        }


        public function storeRequestTransaction(Request $request)
        {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'request_amount' => 'required|numeric|min:1',
                'type' => 'required|in:1,2', // 1 for Deposit, 2 for Withdraw
                'utr_number' => 'nullable|string|max:255',
                'screenshot' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
            ]);
        
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        
            // Handle file upload
            $screenshotPath = null;
            if ($request->hasFile('screenshot')) {
                $screenshotPath = $request->file('screenshot')->store('screenshots', 'public'); // Store in storage/app/public/screenshots
            }
        
            // Insert data into the request_transaction table
            DB::table('request_transaction')->insert([
                'user_id' => $request->user_id,
                'request_amount' => $request->request_amount,
                'type' => $request->type,
                'utr_number' => $request->utr_number,
                'screenshot' => $screenshotPath, // Save the screenshot path
                'request_status' => 'pending', // Default status
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        
            return redirect()->back()->with('success', 'Request submitted successfully.');
        }


    // withdraw page 


    public function showWithdrawPage()
    {
        $userId = auth()->id();
        
        $requests = RequestTransaction::where('user_id', $userId)
                                      ->where('type', 2) // Type 2 for withdrawal
                                      ->get();
    
        return view('withdraw', compact('requests'));
    }
    

    // Handle Withdraw Request
    public function storeWithdrawRequest(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'request_amount' => 'required|numeric|min:1',
            'utr_number' => 'nullable|string',
            'type' => 'required|in:2', // 2 for Withdraw
        ]);

        // Create a new withdrawal request
        RequestTransaction::create([
            'user_id' => $request->user_id,
            'request_amount' => $request->request_amount,
            'utr_number' => $request->utr_number,
            'type' => 2,
            'request_status' => 'pending', // Default status
        ]);

        return redirect()->route('withdraw.page')->with('success', 'Withdrawal request submitted successfully.');
    }
    
   
}

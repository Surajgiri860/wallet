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
use App\Models\config;
use App\Models\PaymentDetail;
use App\Models\AdminPaymentDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;



class DashboardController extends Controller
{
    public function index()
    {
        //die('test');
      $user =   auth()->user(); // This assumes you are using Laravel's built-in authentication.
      
    // Pass the user to the view
    return view('dashboard', compact('user'));

        
      //  return redirect('dashboard');
    }

    public function deposit(Request $request)
{
    $user = Auth::user(); 
    
    if ($user === null) {
        $view = "Templates.Welcome";
        return view('Front', compact('view'));
    }

    // Fetch deposit fee percentage
    $feePercentage = config::where('key', 'deposit_fee')->value('value') ?? 0;  

    if ($request->isMethod('post')) {
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        $amount = $request->input('amount');
        $feeAmount = ($amount * $feePercentage) / 100;
        $netAmount = $amount - $feeAmount;

        $wallet = Wallet::firstOrCreate(['user_id' => $user->id]);
        $wallet->balance += $netAmount;
        $wallet->save();

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'deposit',
            'amount' => $amount,
            'fee' => $feeAmount,
            'final_amount' => $netAmount,
            'status' => 'completed'
        ]);

        return back()->with('success', "Deposit successful! ₹$netAmount added after ₹$feeAmount fee deduction.");
    }

    // Wallet balance and user requests
    $wallet = Wallet::where('user_id', $user->id)->first();
    $requests = DB::table('Request_transaction')->where('user_id', $user->id)->get();

    // Fetch all admin payment methods (Updated logic)
    $paymentDetails = AdminPaymentDetail::all();  // Get all payment methods
    //$paymentDetails = AdminPaymentDetail::latest()->first();  // Fetch the latest payment method
    //$paymentDetails = AdminPaymentDetail::inRandomOrder()->first();  // Fetch a random payment method


    // Send data to the view
    $view = 'Templates.deposit';
    return view('deposit', compact('view', 'user', 'wallet', 'requests', 'feePercentage', 'paymentDetails'));
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
            DB::table('Request_transaction')->insert([
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


    

        public function savePaymentDetails(Request $request)
        {
            $request->validate([
                'account_number' => 'required',
                'ifsc_code' => 'required',
                'bank_name' => 'required',
                'upi_id' => 'nullable'
            ]);

            PaymentDetail::updateOrCreate(
                ['user_id' => auth()->id()],
                [
                    'account_number' => $request->account_number,
                    'ifsc_code' => $request->ifsc_code,
                    'bank_name' => $request->bank_name,
                    'upi_id' => $request->upi_id
                ]
            );

            return redirect()->back()->with('success', 'Payment details updated successfully!');
        }

        public function showPaymentForm()
        {
            $user = auth()->user(); // लॉगिन यूज़र को लो
            $paymentDetails = PaymentDetail::where('user_id', $user->id)->first(); // यूज़र की Payment Details निकालो
        
            return view('payment', compact('paymentDetails'));
        }
        
        public function addMoneyPage()
        {
            $paymentDetails = AdminPaymentDetail::first();
            return view('deposit', compact('paymentDetails'));
        }
    
        public function showChangePasswordForm()
    {
        return view('change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user(); // लॉग इन हुआ User

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password changed successfully.');
    }


}
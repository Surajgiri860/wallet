<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\User;
use App\Models\RequestTransaction; 
use App\Models\config;
use App\Models\Banner;
use App\Models\PaymentDetail;




use Session, DataTables, Redirect, DB, Validator, Form;

class DashboardController extends Controller
{
    protected $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    // Admin Dashboard
    public function index()
    {
        return view('admin.dashboard');
    }

    // Fetch and display all payment requests
    public function paymentRequest()
    {
        $user = $this->service->select();
        $view = 'Admin.paymentPage';

        // Fetch all payment requests from the 'Request_transaction' table
        $paymentRequests = DB::table('Request_transaction')->get();

        // Pass the data to the view
        return view('admin.paymentPage', compact('view', 'user', 'paymentRequests'));
    }

    // Approve Withdraw or Deposit Requests
    public function approveRequest($id)
    {
        // Fetch the transaction using the RequestTransaction model
        $transaction = RequestTransaction::find($id);
    
        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaction not found');
        }
    
        // Fetch the user
        $user = User::find($transaction->user_id);
    
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
    
        DB::beginTransaction(); // Start Transaction
    
        try {
            // Check the transaction type (1 = Deposit, 2 = Withdraw)
            if ($transaction->type == 1) {  // Deposit Case
                // Fetch the current deposit fee percentage from Config
                $feePercentage = Config::where('key', 'deposit_fee')->value('value') ?? 0;
    
                // Calculate the fee amount
                $feeAmount = ($transaction->request_amount * $feePercentage) / 100;
                $finalAmount = $transaction->request_amount - $feeAmount; // Deduct fee
    
                // Add the net deposit amount to the user's total balance
                $user->increment('total_bal', $finalAmount);
            } elseif ($transaction->type == 2) {  // Withdraw Case
                // Directly deduct the requested amount from the user’s balance
                $user->decrement('total_bal', $transaction->request_amount);
            }
    
            // Update the request status to "approved"
            $transaction->update([
                'request_status' => 'approved'
            ]);
    
            DB::commit(); // Commit Transaction
    
            return redirect()->back()->with('success', "Transaction approved. ₹{$finalAmount} added after ₹{$feeAmount} fee deduction.");
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback Transaction on error
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    // Reject a transaction request
    public function rejectRequest($id)
    {
        // Update request status to "rejected"
        DB::table('Request_transaction')->where('id', $id)->update(['request_status' => 'rejected']);

        return redirect()->back()->with('success', 'Transaction rejected');
    }

    // Fetch only withdraw requests
    public function withdrawRequests()
            {
                
                // Fetch withdraw requests from the RequestTransaction model
                $withdrawRequests = RequestTransaction::where('type', 2)->get();  // 2 = Withdraw requests

                
                // Return the view with data
                return view('admin.withdrawRequests', compact('withdrawRequests'));
            }

            public function userlist()
            {
                // Fetch all users (with selected fields) ordered by created_at (optional)
                $users = User::select('name', 'email', 'total_bal', 'created_at')->get();
        
                return view('admin.userlist', compact('users'));
            }
    
            public function showRequestTransaction()
                {
                    // Sirf deposit transactions leke aayein (type = 1)
                    $requests = Request_transaction::where('type', 1)->get();

                    // Data pass karein Blade file me
                    return view('your_view_file', compact('requests'));
                }

                public function updateFee(Request $request)
                {
                    $request->validate([
                        'deposit_fee' => 'required|numeric|min:0|max:100'
                    ]);
                
                    config::updateOrCreate(
                        ['key' => 'deposit_fee'],
                        ['value' => $request->deposit_fee]
                    );
                
                    return back()->with('success', 'Deposit fee updated successfully!');
                }


                public function showFeeForm() {
                    $feePercentage = config::where('key', 'deposit_fee')->value('value') ?? 0;
                    return view('admin.fee', compact('feePercentage'));
                }
                

                public function banner()
                {
                    $banner = Banner::first();
                    return view('admin.banner', compact('banner'));
                }

                public function update(Request $request)
            {
                $request->validate([
                    'title' => 'nullable|string|max:255',
                    'content' => 'nullable|string',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
                ]);

                $banner = Banner::firstOrCreate([]);

                // ✅ Image Upload & Save in Database
                if ($request->hasFile('image')) {
                    $imagePath = $request->file('image')->store('banners', 'public');
                    $banner->image = $imagePath;
                }

                // ✅ Title & Content Save
                $banner->title = $request->title;
                $banner->content = $request->content;
                
                // ✅ Save All Data (Image, Title, Content)
                $banner->save();

                return back()->with('success', 'Banner updated successfully!');
            }

            public function viewPaymentDetails($user_id)
                {
                    $user = User::find($user_id);
                    $paymentDetails = PaymentDetail::where('user_id', $user_id)->first();

                    if (!$paymentDetails) {
                        return redirect()->back()->with('error', 'No payment details found.');
                    }

                    return view('admin.payment_details', compact('user', 'paymentDetails'));
                }

          
                


}

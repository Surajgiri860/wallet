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
use App\Models\AdminPaymentDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;






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
        $totalBalance = User::sum('total_bal');
        return view('admin.dashboard', compact('totalBalance'));
    }

    // Fetch and display all payment requests
    public function paymentRequest()
    {
        $user = $this->service->select();
        $view = 'Admin.paymentPage';
    
        // Fetch payment requests with user data
        $paymentRequests = RequestTransaction::with('user')->get();
    
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
        // Withdraw requests के साथ user डेटा लोड करें
        $withdrawRequests = RequestTransaction::where('type', 2)
                              ->with('user')  // यह user की जानकारी भी लाएगा
                              ->get(); 
    
        return view('admin.withdrawRequests', compact('withdrawRequests'));
    }
    

            public function userlist()
            {
                // Ensure 'id' is also selected
                $users = User::select('id', 'name', 'email', 'total_bal', 'status', 'created_at')->get();
            
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

                // Show Payment Settings Page
                public function showAdminPaymentSettings()
                {
                    $paymentDetails = AdminPaymentDetail::all(); // Get all accounts
                    return view('admin.payment_settings', compact('paymentDetails'));
                }

                // Save Payment Details
                public function savePaymentDetails(Request $request)
                {
                    $request->validate([
                        'upi_id' => 'required',
                        'bank_name' => 'required',
                        'account_number' => 'required',
                        'ifsc_code' => 'required',
                        'qrpic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                    ]);

                    $paymentDetail = new AdminPaymentDetail();
                    $paymentDetail->upi_id = $request->upi_id;
                    $paymentDetail->bank_name = $request->bank_name;
                    $paymentDetail->account_number = $request->account_number;
                    $paymentDetail->ifsc_code = $request->ifsc_code;

                    if ($request->hasFile('qrpic')) {
                        $path = $request->file('qrpic')->store('payment_qr_codes', 'public');
                        $paymentDetail->qrpic = $path;
                    }

                    $paymentDetail->save();

                    return redirect()->route('admin.paymentSettings')->with('success', 'Payment details saved successfully!');
                }
            
          
                public function blockUser($id)
                    {
                        $user = User::findOrFail($id);
                        $user->status = 'blocked';
                        $user->save();
                        
                        return back()->with('success', 'User has been blocked.');
                    }

                    public function unblockUser($id)
                    {
                        $user = User::findOrFail($id);
                        $user->status = 'active';
                        $user->save();

                        return back()->with('success', 'User has been unblocked.');
                    }

                    public function deleteUser($id)
                    {
                        $user = User::findOrFail($id);
                        $user->delete();

                        return back()->with('success', 'User has been deleted.');
                    }
                    
                    public function deletePaymentDetails($id)
                    {
                        $payment = AdminPaymentDetail::find($id);
                        if ($payment) {
                            // अगर QR Code Image सेव है तो डिलीट करें
                            if ($payment->qrpic) {
                                Storage::delete('public/' . $payment->qrpic);
                            }

                            $payment->delete();
                            return redirect()->route('admin.paymentSettings')->with('success', 'Payment method deleted successfully.');
                        }

                        return redirect()->route('admin.paymentSettings')->with('error', 'Payment method not found.');
                    }

                    public function showChangePasswordForm()
                    {
                        return view('admin.change-password');
                    }
                
                    public function updatePassword(Request $request)
                    {
                        $request->validate([
                            'current_password' => 'required',
                            'new_password' => 'required|min:8|confirmed',
                        ]);
                
                        $admin = Auth::user(); // लॉग इन हुआ Admin 
                
                        if (!Hash::check($request->current_password, $admin->password)) {
                            return back()->withErrors(['current_password' => 'Current password is incorrect']);
                        }
                
                        $admin->password = Hash::make($request->new_password);
                        $admin->save();
                
                        return back()->with('success', 'Password changed successfully.');
                    }


                }

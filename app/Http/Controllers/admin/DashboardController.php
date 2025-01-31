<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\User;
use App\Models\RequestTransaction; 


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
        return view('Admin.paymentPage', compact('view', 'user', 'paymentRequests'));
    }

    // Approve Withdraw or Deposit Requests
    public function approveRequest($id)
        {
            // Fetch the transaction using the RequestTransaction model
            $transaction = RequestTransaction::find($id);

            if (!$transaction) {
                return redirect()->back()->with('error', 'Transaction not found');
            }

            // Check the transaction type (1 = Deposit, 2 = Withdraw)
            if ($transaction->type == 1) {
                // Deposit: Add to the user's total balance
                $user = User::find($transaction->user_id);
                $user->increment('total_bal', $transaction->request_amount);
            } elseif ($transaction->type == 2) {
                // Withdraw: Subtract from the user's total balance
                $user = User::find($transaction->user_id);
                $user->decrement('total_bal', $transaction->request_amount);
            }

            // Update the request status to "approved"
            $transaction->update(['request_status' => 'approved']);

            return redirect()->back()->with('success', 'Transaction approved and balance updated');
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
}

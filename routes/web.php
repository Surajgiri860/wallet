<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;

use App\Http\Controllers\WalletController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Models\AdminPaymentDetail;




Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' =>'account'],function(){

    //guest middleware
    Route::group(['middleware' =>'guest'],function(){
        Route::get('login',[LoginController::class,'index'])->name('account.login');
        Route::get('register',[LoginController::class,'register'])->name('account.register');
        Route::post('process-register',[LoginController::class,'processRegister'])->name('account.processRegister');
        Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');


    });

    //Authenticate middleware
    Route::group(['middleware' =>'auth'],function(){
        Route::get('logout',[LoginController::class,'logout'])->name('account.logout');
   
        Route::get('/dashboard',[DashboardController::class,'index'])->name('account.dashboard');

        Route::get('deposit', [DashboardController::class, 'deposit'])->name('account.deposit');
        Route::post('/request-transaction', [DashboardController::class, 'storeRequestTransaction'])->name('request.transaction');

        Route::get('/withdraw', [DashboardController::class, 'showWithdrawPage'])->name('withdraw.page');
        Route::post('/withdraw-request', [DashboardController::class, 'storeWithdrawRequest'])->name('withdraw.request');

        //Route::get('/user/payment-details', [DashboardController::class, 'paymentDetailsForm'])->name('user.paymentDetails');
        Route::post('/user/save-payment-details', [DashboardController::class, 'savePaymentDetails'])->name('user.savePaymentDetails');
        Route::get('/user/payment', [DashboardController::class, 'showPaymentForm'])->name('user.payment');

       // Route::get('/dashboard', [UserController::class, 'dashboard']);

        
           });

});


Route::group(['prefix' =>'admin'],function(){

    //guest middleware for admin
    Route::group(['middleware' =>'admin.guest'],function(){
        Route::get('login',[AdminLoginController::class,'index'])->name('admin.login');
        Route::post('authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');


    });

    //Authenticate middleware for admin
    Route::group(['middleware' =>'admin.auth'],function(){
        Route::get('dashboard',[AdminDashboardcontroller::class,'index'])->name('admin.dashboard');
        Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

        Route::get('/payment-requests', [AdminDashboardController::class, 'paymentRequest'])->name('admin.paymentRequests');
        Route::get('/withdraw-requests', [AdminDashboardController::class, 'withdrawRequests'])->name('admin.withdrawRequests');
        Route::post('/approve-request/{id}', [AdminDashboardController::class, 'approveRequest'])->name('admin.approveRequest');
        Route::post('/reject-request/{id}', [AdminDashboardController::class, 'rejectRequest'])->name('admin.rejectRequest');
        Route::get('/users', [AdminDashboardController::class, 'Userlist'])->name('users.index');
        Route::get('/request-transaction', [AdminDashboardController::class, 'showRequestTransaction']);
        Route::get('/fee', [AdminDashboardController::class, 'showFeeForm'])->name('fee.form');
        Route::post('/update-fee', [AdminDashboardController::class, 'updateFee'])->name('update.fee');

        Route::get('/banner', [AdminDashboardController::class, 'banner'])->name('admin.banner');
        Route::post('/banner/update', [AdminDashboardController::class, 'update'])->name('admin.banner.update');
        
        Route::get('/payment-details/{user_id}', [AdminDashboardController::class, 'viewPaymentDetails'])->name('admin.viewPaymentDetails');


        

        // Admin Payment Settings Page
        Route::get('/payment-settings', [AdminDashboardController::class, 'showAdminPaymentSettings'])->name('admin.paymentSettings');

        // Save Payment Details
        Route::post('/save-payment-details', [AdminDashboardController::class, 'savePaymentDetails'])->name('admin.savePaymentDetails');

        Route::get('/block-user/{id}', [AdminDashboardController::class, 'blockUser'])->name('admin.blockUser');
        Route::get('/unblock-user/{id}', [AdminDashboardController::class, 'unblockUser'])->name('admin.unblockUser');
        Route::get('/delete-user/{id}', [AdminDashboardController::class, 'deleteUser'])->name('admin.deleteUser');

    });
    });







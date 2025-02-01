<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;

use App\Http\Controllers\WalletController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Dashboardcontroller;
use App\Http\Controllers\UserController;




Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' =>'account'],function(){

    //guest middleware
    Route::group(['middleware' =>'guest'],function(){
        Route::get('login',[Logincontroller::class,'index'])->name('account.login');
        Route::get('register',[Logincontroller::class,'register'])->name('account.register');
        Route::post('process-register',[Logincontroller::class,'processRegister'])->name('account.processRegister');
        Route::post('/authenticate', [Logincontroller::class, 'authenticate'])->name('account.authenticate');


    });

    //Authenticate middleware
    Route::group(['middleware' =>'auth'],function(){
        Route::get('logout',[Logincontroller::class,'logout'])->name('account.logout');
        Route::get('/dashboard',[Dashboardcontroller::class,'index'])->name('account.dashboard');


        Route::get('deposit', [Dashboardcontroller::class, 'deposit'])->name('account.deposit');
        Route::post('/request-transaction', [Dashboardcontroller::class, 'storeRequestTransaction'])->name('request.transaction');

        Route::get('/withdraw', [Dashboardcontroller::class, 'showWithdrawPage'])->name('withdraw.page');
        Route::post('/withdraw-request', [Dashboardcontroller::class, 'storeWithdrawRequest'])->name('withdraw.request');

        
        Route::get('/dashboard', [UserController::class, 'dashboard']);

        
           });

});


Route::group(['prefix' =>'admin'],function(){

    //guest middleware for admin
    Route::group(['middleware' =>'admin.guest'],function(){
        Route::get('login',[AdminLoginController::class,'index'])->name('admin.login');
        Route::post('authenticate',[AdminLogincontroller::class,'authenticate'])->name('admin.authenticate');


    });

    //Authenticate middleware for admin
    Route::group(['middleware' =>'admin.auth'],function(){
        Route::get('dashboard',[AdminDashboardcontroller::class,'index'])->name('admin.dashboard');
        Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

        Route::get('/payment-requests', [AdminDashboardcontroller::class, 'paymentRequest'])->name('admin.paymentRequests');
        Route::get('/withdraw-requests', [AdminDashboardcontroller::class, 'withdrawRequests'])->name('admin.withdrawRequests');
        Route::post('/approve-request/{id}', [AdminDashboardcontroller::class, 'approveRequest'])->name('admin.approveRequest');
        Route::post('/reject-request/{id}', [AdminDashboardcontroller::class, 'rejectRequest'])->name('admin.rejectRequest');
        Route::get('/users', [AdminDashboardcontroller::class, 'Userlist'])->name('users.index');
        Route::get('/request-transaction', [AdminDashboardcontroller::class, 'showRequestTransaction']);
        Route::get('/fee', [AdminDashboardcontroller::class, 'showFeeForm'])->name('fee.form');
        Route::post('/update-fee', [AdminDashboardcontroller::class, 'updateFee'])->name('update.fee');

        Route::get('/banner', [AdminDashboardcontroller::class, 'banner'])->name('admin.banner');
        Route::post('/banner/update', [AdminDashboardcontroller::class, 'update'])->name('admin.banner.update');
    
    });
    });







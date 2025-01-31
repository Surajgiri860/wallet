<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('wallet_id');
            $table->string('utr_number')->nullable();
            $table->string('diposit_image')->nullable();
            $table->text('remark')->nullable();
            $table->decimal('deposit_amount', 10, 2);
            $table->decimal('withdraw_amount', 10, 2)->nullable();
            $table->enum('request_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('wallet_transactions');
    }
}
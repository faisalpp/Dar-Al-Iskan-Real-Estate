<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->string('wallet_address')->nullable();
            $table->string('proof')->nullable();
            $table->string('bank_name')->nullable();
            $table->enum('type',['EXTEND MEMBERSHIP','MEMBERSHIP FEE','INVEST','REFERRAL BONUS','WITHDRAW','PROFIT']);
            $table->enum('status',['PENDING','APPROVED','REJECTED','EXPIRED'])->default('PENDING');
            $table->string('expiration_date')->nullable();
            $table->float('amount')->nullable();
            $table->string('message')->nullable();
            $table->string('acc_holder_name')->nullable();
            $table->string('withdraw_fee')->nullable();
            $table->string('user_name');
            $table->foreign('user_name')->references('user_name')->on('users');
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->foreign('plan_id')->references('plan_id')->on('plans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};

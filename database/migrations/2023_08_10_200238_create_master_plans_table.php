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
        Schema::create('master_plans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('investment');
            $table->integer('duration');
            $table->string('join_text');
            $table->string('whatsapp');
            $table->integer('daily_income');
            $table->integer('withdraw_fee');
            $table->integer('ref_com1');
            $table->integer('ref_com2');
            $table->integer('ref_com3');
            $table->integer('ref_com4');
            $table->integer('ref_com5');
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
        Schema::dropIfExists('master_plans');
    }
};

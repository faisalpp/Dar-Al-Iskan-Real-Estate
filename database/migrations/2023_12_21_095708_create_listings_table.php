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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('client')->default('guest');
            $table->string('serial_no');
            $table->string('title');
            $table->string('size');
            $table->string('location')->nullable();
            $table->string('lat_lng')->nullable();
            $table->string('type');
            $table->string('amount');
            $table->string('status');
            $table->string('no_bedrooms')->default('0');
            $table->string('no_toilets')->default('0');
            $table->string('no_majlis')->default('0');
            $table->string('no_floors')->default('0');
            $table->string('no_kitchens')->default('0');
            $table->json('media')->nullable();
            $table->string('created_by');
            $table->string('updated_by');
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
        Schema::dropIfExists('listings');
    }
};

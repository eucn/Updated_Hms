<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table ->bigIncrements('id');
            $table ->unsignedBigInteger('guest_id');
            $table ->unsignedBigInteger('room_id');
            $table ->string('book_status');
            $table ->integer('nights');
            $table ->date('checkin_date');
            $table ->date('checkout_date');
            $table ->integer('base_price');
            $table ->integer('total_price');
            $table ->integer('guests_num');
            $table ->integer('guestsFee');
            $table ->integer('extra_bed');
            $table->timestamps();
             $table->foreign('room_id')
                  ->references('id')->on('manage_room')
                  ->onDelete('cascade');
            $table->foreign('guest_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};

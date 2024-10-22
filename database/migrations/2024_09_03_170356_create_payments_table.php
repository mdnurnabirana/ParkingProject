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
         Schema::create('payments', function (Blueprint $table) {
             $table->bigIncrements('payment_id');
             $table->unsignedBigInteger('booking_id');
             $table->decimal('amount', 8, 2);
             $table->enum('payment_method', ['cash', 'bkash', 'nagad', 'credit_card']);
             $table->string('transaction_number')->nullable();
             $table->enum('payment_status', ['pending', 'confirmed', 'failed'])->default('pending');
             $table->timestamp('confirmed_at')->nullable();
             $table->timestamps();

             $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
         });
     }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

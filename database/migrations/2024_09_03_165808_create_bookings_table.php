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
         Schema::create('bookings', function (Blueprint $table) {
             $table->bigIncrements('booking_id');
             $table->unsignedBigInteger('user_id');
             $table->unsignedBigInteger('park_id');
             $table->timestamp('booking_date')->useCurrent();
             $table->decimal('total_amount', 8, 2);
             $table->enum('payment_method', ['cash', 'bkash', 'nagad', 'credit_card']);
             $table->string('transaction_number')->nullable();
             $table->enum('status', ['pending', 'confirmed', 'canceled', 'completed'])->default('pending');
             $table->timestamps();

             $table->foreign('user_id')->references('user_id')->on('park_users')->onDelete('cascade');
             $table->foreign('park_id')->references('park_id')->on('park_spaces')->onDelete('cascade');
         });
     }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

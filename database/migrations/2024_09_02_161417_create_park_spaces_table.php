<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkSpacesTable extends Migration
{
    public function up()
    {
        Schema::create('park_spaces', function (Blueprint $table) {
            $table->id('park_id'); // Primary Key
            $table->string('address');
            $table->string('park_name');
            $table->string('park_pic')->nullable();
            $table->text('park_facilities')->nullable();
            $table->decimal('park_rent', 8, 2)->nullable();
            $table->enum('payment_method', ['cash', 'bkash', 'nagad', 'credit_card'])->nullable();
            $table->string('bkash_number')->nullable();
            $table->string('nagad_number')->nullable();
            $table->integer('total_spaces');
            $table->integer('available_spaces');
            $table->string('owner_number');
            $table->string('availability_time');
            $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('park_spaces');
    }
}

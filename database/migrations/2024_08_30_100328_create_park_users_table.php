<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkUsersTable extends Migration
{
    public function up()
    {
        Schema::create('park_users', function (Blueprint $table) {
            $table->id('user_id'); // Primary key
            $table->string('fname');
            $table->string('lname');
            $table->string('mobile', 20)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('vehicle_type', ['CNG', 'AUTO RICKSHAW', 'CAR', 'NOHA', 'TEMPO', 'OTHER']);
            $table->string('vehicle_reg_no', 50)->unique();
            $table->string('vehicle_pic')->nullable();
            $table->text('address');
            $table->enum('gender', ['male', 'female', 'prefer not to say']);
            $table->string('user_pic')->nullable(); // Column to store user photo filename
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('park_users');
    }
}

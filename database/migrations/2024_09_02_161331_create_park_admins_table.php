<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParkAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('park_admins', function (Blueprint $table) {
            $table->id('admin_id'); // Primary Key
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('park_admins');
    }
}

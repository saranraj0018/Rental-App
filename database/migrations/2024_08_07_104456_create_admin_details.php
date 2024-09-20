<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admin_details', function (Blueprint $table) {
            $table->mediumInteger('id');
            $table->string('user_name',144)->default(null);
            $table->string('email',64);
            $table->string('password',144);
            $table->smallInteger('role')->default(null);
            $table->string('mobile_number',15)->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_details');
    }
};

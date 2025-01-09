<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('coupon_histories', function (Blueprint $table) {
            $table->id();
            $table->string('action');
            $table->string('title');
            $table->string('amount');
            $table->string('description');
            $table->string('start_date');
            $table->string('end_date');
            $table->integer('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('coupon_histories');
    }
};

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
        Schema::create('car_blocks', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->tinyInteger('block_type')->default(0)->comment('0-maintenance, 1-discretionary, 2-availability_type, 3-u-refurbish, 4-u-recovery, 5-lt-reserve');
            $table->json('product_type')->nullable();
            $table->json('customer_type')->nullable();
            $table->json('repeat_customer')->nullable();
            $table->json('banned_customer')->nullable();
            $table->json('corporate_customer')->nullable();
            $table->smallInteger('hub');
            $table->string('car_model',80);
            $table->string('booking_id',50)->nullable();
            $table->string('car_register_number', 50);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('commend', 255)->nullable();
            $table->tinyInteger('reason')->nullable()->comment('0-major_repair, 1-accident, 2-running_repair, 3-service, 4-others, 5-buffer, 6-gps-issue, 7-forced-extension, 8-others');
            $table->Integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_parking');
    }
};

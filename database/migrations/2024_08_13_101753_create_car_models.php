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
        Schema::create('car_models', function (Blueprint $table) {
            $table->Integer('id')->autoIncrement();
            $table->string('car_model_id')->unique();
            $table->string('producer',144);
            $table->string('model_name',50)->unique();
            $table->string('seat',15);
            $table->string('fuel_type',30);
            $table->string('transmission',50);
            $table->string('engine_power',80);
            $table->decimal('price_per_hour',18,2);
            $table->decimal('extra_hours_price',18,2);
            $table->smallInteger('dep_amount');
            $table->mediumInteger('per_day_km')->default(0);
            $table->string('weekend_surge',144);
            $table->string('peak_reason_surge',144);
            $table->decimal('extra_km_charge',18,2);
            $table->string('car_image',144);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_models');
    }
};

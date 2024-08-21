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
        Schema::create('car_details', function (Blueprint $table) {
            $table->Integer('id')->autoIncrement();
            $table->string('city_name',144);
            $table->mediumInteger('city_code');
            $table->string('hub',144);
            $table->mediumInteger('hub_code');
            $table->string('model_id');
            $table->string('register_number',144);
            $table->mediumInteger('current_km');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_details');
    }
};

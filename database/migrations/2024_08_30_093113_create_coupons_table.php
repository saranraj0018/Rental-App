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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->smallInteger('user_id');
            $table->string('title',144);
            $table->string('description');
            $table->decimal('amount',18,2)->default(0);
            $table->tinyInteger('type')->nullable()->comment('1-percentage, 2-fixed');
            $table->string('prefix',144)->nullable();
            $table->string('code',20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};

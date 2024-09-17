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
        Schema::create('carwash_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('car_id');
            $table->decimal('amount', 15,2);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->foreign('service_id')->references('id')->on('carwash_services')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carwash_prices');
    }
};

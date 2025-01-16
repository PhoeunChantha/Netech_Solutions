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
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->string('product_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->double('price',15, 2)->default(0.00)->nullable();
            $table->double('discount')->default(0.00)->nullable();
            $table->string('discount_type')->nullable();
            $table->string('status')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderdetails');
    }
};

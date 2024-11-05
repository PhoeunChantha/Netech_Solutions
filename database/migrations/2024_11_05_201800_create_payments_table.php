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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('payment_method')->nullable(); // e.g., 'credit_card', 'paypal', 'bank_transfer'
            $table->date('payment_date')->nullable(); // Date when the payment was made
            $table->decimal('amount', 15, 2)->nullable(); // Amount paid
            $table->string('status')->default('pending'); // e.g., 'completed', 'pending', 'failed'
            $table->text('outline_payment')->nullable(); // Additional notes or description
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->date('invoice_date')->nullable();
            $table->decimal('total_amount', 15, 2)->nullable(); // Total amount billed on the invoice
            $table->decimal('paid_amount', 15, 2)->default(0); // Amount paid
            $table->string('status')->default('unpaid'); // Status: unpaid, paid, pending, etc.
            $table->date('due_date')->nullable(); // Due date for payment
            $table->string('payment_method')->nullable(); // Payment method used, if any
            $table->text('notes')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

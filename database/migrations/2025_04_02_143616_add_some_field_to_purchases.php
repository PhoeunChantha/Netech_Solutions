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
        Schema::table('purchases', function (Blueprint $table) {
            $table->decimal('dollar_amount', 10, 2)->nullable();
            $table->decimal('riel_amount', 10, 2)->nullable();
            $table->decimal('payment_due', 10, 2)->nullable();
            $table->string('bank_no')->nullable();
            $table->string('payment_method')->nullable();
            $table->text('payment_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropColumn('dollar_amount');
            $table->dropColumn('riel_amount');
            $table->dropColumn('payment_due');
            $table->dropColumn('bank_no');
            $table->dropColumn('payment_method');
            $table->dropColumn('payment_note');
        });
    }
};

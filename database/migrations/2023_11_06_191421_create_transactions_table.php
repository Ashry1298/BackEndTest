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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sub_category_id')->constrained('categories')->cascadeOnDelete();
            $table->decimal('amount');
            $table->decimal('amount_paid')->default(0);
            $table->integer('status')->default(0);
            $table->integer('payment_method')->default(0);
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->dateTime('due_on');
            $table->decimal('vat');
            $table->boolean('is_vat_inclusive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

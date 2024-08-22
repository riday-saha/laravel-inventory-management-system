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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('products_id');
            $table->unsignedBigInteger('customer_id');
            $table->integer('quantity');
            $table->enum('status', ['Pending', 'Completed'])->default('Pending');
            $table->string('payment_method');
            $table->decimal('paid_amount', 8, 2); 
            $table->decimal('due_amount', 8, 2);
            $table->foreign('products_id')->references('id')->on('products');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

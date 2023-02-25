<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('parent_id')->nullable();
            $table->text('invoice_no')->nullable();
            $table->text('customer_name')->nullable();
            $table->text('email')->nullable();
            $table->text('terms')->nullable();
            $table->date('invoice_date')->nullable();
            $table->date('due_date')->nullable();
            $table->text('location')->nullable();
            $table->text('memo')->nullable();
            $table->text('message_on_invoice')->nullable();
            $table->string('send_later')->nullable();
            $table->text('product_service')->nullable();
            $table->text('description')->nullable();
            $table->decimal('qty', 10)->nullable();
            $table->decimal('rate', 10)->nullable();
            $table->decimal('amount', 10)->nullable();
            $table->decimal('tax_rate', 10)->nullable();
            $table->decimal('total', 10)->nullable();
            $table->boolean('sent')->default(0);

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

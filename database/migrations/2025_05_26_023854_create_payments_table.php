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
            $table->foreignId('user_id')->constrained();
            $table->foreignId('service_id')->constrained()->nullable(); // Link to service if applicable
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('MYR');
            $table->string('payment_method'); // stripe, fpx, etc.
            $table->string('status'); // pending, completed, failed, cancelled
            $table->string('gateway_reference')->nullable(); // Stripe session/charge ID
            $table->json('gateway_data')->nullable(); // Store additional gateway response data
            $table->timestamp('paid_at')->nullable();
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

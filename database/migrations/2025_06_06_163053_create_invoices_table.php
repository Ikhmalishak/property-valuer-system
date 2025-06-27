<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id('invoice_id');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->string('invoice_number');
            $table->decimal('amount', 10, 2);
            $table->dateTime('due_date');
            $table->string('status'); // 'pending', 'paid', 'overdue'
            $table->dateTime('issued_date');
            $table->string('reminder_frequency'); // 'weekly', 'monthly', 'none'
            $table->dateTime('last_reminder_sent')->nullable();
            $table->boolean('amanah_raya_paid')->default(false);
            $table->boolean('is_reminder_sent')->default(false);
            $table->string('file_name')->nullable();
            $table->text('file_path')->nullable();
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

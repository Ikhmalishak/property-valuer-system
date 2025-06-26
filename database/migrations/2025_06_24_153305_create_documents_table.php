<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            $table->string('file_name');        // e.g. Invoice_June2025.pdf
            $table->string('file_path');        // stored path like 'invoices/Invoice_June2025.pdf'
            $table->string('file_type');        // e.g. pdf, docx, xlsx
            $table->string('category')->nullable(); // e.g. invoice, report, etc.
            $table->bigInteger('size')->nullable(); // file size in bytes

            $table->timestamps();               // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};

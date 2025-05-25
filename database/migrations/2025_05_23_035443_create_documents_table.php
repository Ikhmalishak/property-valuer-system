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
        Schema::create('documents', function (Blueprint $table) {
            $table->id('document_id');

            $table->foreignId('application_id')->constrained('applications', 'application_id')->onDelete('cascade');

            $table->string('file_name');
            $table->string('file_type'); // e.g., pdf, jpeg, png
            $table->string('file_path'); // stored path
            $table->timestamp('upload_date')->useCurrent();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};

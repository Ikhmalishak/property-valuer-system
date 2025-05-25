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
        Schema::create('applications', function (Blueprint $table) {
            $table->id('application_id');

            // User & Service Relationship
            $table->foreignId('user_id')->constrained('users',)->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->foreignId('application_status_id')->constrained('application_statuses')->onDelete('cascade');

            // Fields from the form
            $table->string('full_name');
            $table->string('ic_number');
            $table->text('property_address');
            $table->string('email');
            $table->string('phone');
            $table->text('additional_info')->nullable();

            // Application meta
            $table->timestamp('submission_date')->useCurrent();
            $table->timestamp('last_updated')->useCurrent();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};

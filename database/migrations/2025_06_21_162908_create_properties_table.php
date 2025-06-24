<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('nombor_kait')->nullable();
            $table->string('nombor_lot'); // e.g., house, car
            $table->string('nombor_geran')->nullable();
            $table->string('daerah')->nullable();
            $table->string('mukim')->nullable();
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
        Schema::dropIfExists('properties');
    }
};

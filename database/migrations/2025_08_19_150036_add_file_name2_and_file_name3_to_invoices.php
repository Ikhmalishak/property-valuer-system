<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            // File paths (to store the file location in storage)
            $table->string('file_path2')->nullable();
            $table->string('file_path3')->nullable();

            // File names (to store original filename)
            $table->string('file_name2')->nullable();
            $table->string('file_name3')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn(['file_path2', 'file_name2', 'file_path3', 'file_name3']);
        });
    }
};
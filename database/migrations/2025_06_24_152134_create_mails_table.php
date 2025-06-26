<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->json('from')->nullable();
            $table->json('reply_to')->nullable();
            $table->json('to')->nullable();
            $table->json('cc')->nullable();
            $table->json('bcc')->nullable();
            $table->longText('html')->nullable();
            $table->longText('text')->nullable();
            $table->uuid('uuid')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->string('mailer')->nullable();
            $table->string('stream_id')->nullable();
            $table->string('transport')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mails');
    }
};

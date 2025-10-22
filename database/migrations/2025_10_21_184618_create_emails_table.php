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
        Schema::create('emails', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();

            $table->string('from_address');

            $table->string('to_address');

            $table->string('cc_address')->nullable();

            $table->string('subject');
            $table->text('body');
            $table->enum('type', ['text', 'html']);

            $table->ipAddress('ip_address');
            $table->text('user_agent');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};

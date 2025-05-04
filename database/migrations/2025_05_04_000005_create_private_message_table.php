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
        Schema::create('private_conversation', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('from');
            $table->bigInteger('to');
            $table->integer('messages_count');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();
        });

        Schema::create('private_messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('conversation');
            $table->bigInteger('owner');
            $table->longText('message');
            $table->timestamp('created_at')->useCurrent();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};

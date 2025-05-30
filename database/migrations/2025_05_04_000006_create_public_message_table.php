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

        Schema::create('public_messages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('owner');
            $table->longText('message');
            $table->timestamp('created_at')->useCurrent();
            $table->bigInteger('neighborhood');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};

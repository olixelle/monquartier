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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->bigInteger('owner');
            $table->bigInteger('neighborhood');
            $table->bigInteger('category');
            $table->enum('type', ['offer', 'request']);
            $table->enum('status', ['disabled', 'enabled']);
            $table->integer('price');
            $table->string('image')->nullable();
            $table->longText('description');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};

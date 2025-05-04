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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->string('location')->nullable();
            $table->string('image')->nullable();
            $table->bigInteger('owner');
            $table->bigInteger('neighborhood');
            $table->date('starts_at');
            $table->date('ends_at')->nullable();
            $table->integer('duration')->default(0);
            $table->tinyInteger('requires_reservation')->default(0);
            $table->integer('seats_total')->default(0);
            $table->integer('seats_available')->default(0);
            $table->enum('duration_unit', ['min', 'hour', 'day'])->nullable();
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

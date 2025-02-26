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
        Schema::create('clans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('motto')->nullable()->comment('Девиз');
            $table->string('avatar_url')->nullable();
            $table->foreignId('leader_id')->constrained('users')->onDelete('cascade');
            $table->integer('points')->default(1000);
            $table->string('division')->default('D')->comment('Дивизион A, B, C, D');
            $table->unsignedSmallInteger('minimal_rating')->default(0)->comment('Минимальный рейтинг для вступления в клан');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clans');
    }
};

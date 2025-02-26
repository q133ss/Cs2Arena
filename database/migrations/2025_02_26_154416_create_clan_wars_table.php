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
        Schema::create('clan_wars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clan1_id')->constrained('clans')->onDelete('cascade');
            $table->foreignId('clan2_id')->constrained('clans')->onDelete('cascade');
            $table->enum('status', ['pending', 'active', 'completed', 'disputed'])->default('pending');
            $table->string('server_ip')->nullable();
            $table->string('server_password')->nullable();
            $table->json('selected_maps')->nullable();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->json('result')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clan_wars');
    }
};

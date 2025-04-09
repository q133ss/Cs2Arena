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
        Schema::create('maths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('server_id')->constrained('mix_servers')->cascadeOnDelete();
            $table->string('map');
            $table->json('result')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'finished'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maths');
    }
};

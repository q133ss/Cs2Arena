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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamp('start_time')->nullable()->comment('Время начала регистрации');
            $table->timestamp('end_registration_time')->nullable()->comment('Время окончания регистрации');
            $table->timestamp('tournament_start_time')->nullable()->comment('Время начала турнира');
            $table->unsignedTinyInteger('size')->comment('Кол-во команд. Например 2,4,6,8,16');
            $table->json('accepted_divisions')->nullable()->comment('Какие дивизионы могут отправить заявку. Например [a,b||c,d]');
            $table->enum('status', ['pending', 'active', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};

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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('cw_count')->default(0)->after('steam_id')->comment('Количество сыгранных матчей в клановых войнах');
            $table->unsignedInteger('cw_wins')->default(0)->after('cw_count')->comment('Количество побед в клановых войнах');
            $table->unsignedInteger('cw_losses')->default(0)->after('cw_wins')->comment('Количество поражений в клановых войнах');
            $table->unsignedInteger('mix_count')->default(0)->after('cw_losses')->comment('Количество сыгранных матчей в миксах');
            $table->unsignedInteger('mix_wins')->default(0)->after('mix_count')->comment('Количество побед в миксах');
            $table->unsignedInteger('mix_losses')->default(0)->after('mix_wins')->comment('Количество поражений в миксах');
            $table->unsignedInteger('total_matches')->default(0)->after('mix_losses')->comment('Количество сыгранных матчей в клановых войнах и миксах');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cw_count');
            $table->dropColumn('cw_wins');
            $table->dropColumn('cw_losses');
            $table->dropColumn('mix_count');
            $table->dropColumn('mix_wins');
            $table->dropColumn('mix_losses');
            $table->dropColumn('total_matches');
        });
    }
};

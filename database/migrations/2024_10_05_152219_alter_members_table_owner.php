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
        Schema::table('members', function (Blueprint $table) {
            if (!Schema::hasColumn('members', 'inn_owner_address')) {
                $table->text('inn_owner_address')->nullable();
            }

            if (!Schema::hasColumn('members', 'family')) {
                $table->string('family')->nullable();
            }

            if (!Schema::hasColumn('members', 'family_phone')) {
                $table->string('family_phone')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            if (Schema::hasColumn('members', 'inn_owner_address')) {
                $table->dropColumn('inn_owner_address');
            }

            if (Schema::hasColumn('members', 'family')) {
                $table->dropColumn('family');
            }

            if (Schema::hasColumn('members', 'family_phone')) {
                $table->dropColumn('family_phone');
            }
        });
    }
};

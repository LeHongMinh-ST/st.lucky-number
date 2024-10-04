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

            if (!Schema::hasColumn('members', 'email')) {
                $table->string('email')->nullable();
            }

            if (!Schema::hasColumn('members', 'address')) {
                $table->string('address')->nullable();
            }

            if (!Schema::hasColumn('members', 'code')) {
                $table->string('code')->nullable();
            }

            if (!Schema::hasColumn('members', 'address_now')) {
                $table->string('address_now')->nullable();
            }

            if (!Schema::hasColumn('members', 'inn_owner')) {
                $table->string('inn_owner')->nullable();
            }
            if (!Schema::hasColumn('members', 'inn_owner_phone')) {
                $table->string('inn_owner_phone')->nullable();
            }
            if (!Schema::hasColumn('members', 'class')) {
                $table->string('class')->nullable();
            }
            if (!Schema::hasColumn('members', 'faculty')) {
                $table->string('faculty')->nullable();
            }
            if (!Schema::hasColumn('members', 'gender')) {
                $table->string('gender')->nullable();
            }

            if (!Schema::hasColumn('members', 'ethnicity')) {
                $table->string('ethnicity')->nullable();
            }

            if (!Schema::hasColumn('members', 'school_year')) {
                $table->string('school_year')->nullable();
            }

            if (!Schema::hasColumn('members', 'is_inn')) {
                $table->boolean('is_inn')->default(false);
            }

            $table->string('code_id')->nullable(true)->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            if (Schema::hasColumn('members', 'address')) {
                $table->dropColumn('address');
            }
            if (Schema::hasColumn('members', 'code')) {
                $table->dropColumn('code');
            }
            if (Schema::hasColumn('members', 'address_now')) {
                $table->dropColumn('address_now');
            }
            if (Schema::hasColumn('members', 'inn_owner')) {
                $table->dropColumn('inn_owner');
            }
            if (Schema::hasColumn('members', 'inn_owner_phone')) {
                $table->dropColumn('inn_owner_phone');
            }
            if (Schema::hasColumn('members', 'class')) {
                $table->dropColumn('class');
            }
            if (Schema::hasColumn('members', 'faculty')) {
                $table->dropColumn('faculty');
            }
            if (Schema::hasColumn('members', 'gender')) {
                $table->dropColumn('gender');
            }
            if (Schema::hasColumn('members', 'email')) {
                $table->dropColumn('email');
            }

            $table->string('code_id')->nullable(false)->change();

            if (Schema::hasColumn('members', 'ethnicity')) {
                $table->dropColumn('ethnicity');
            }

            if (Schema::hasColumn('members', 'school_year')) {
                $table->dropColumn('school_year');
            }

            if (Schema::hasColumn('members', 'is_inn')) {
                $table->dropColumn('is_inn');
            }
        });
    }
};

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
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->nullable();
            }
            if (!Schema::hasColumn('users', 'perusahaan')) {
                $table->string('perusahaan')->nullable();
            }
            if (!Schema::hasColumn('users', 'departemen')) {
                $table->string('departemen')->nullable();
            }
            if (!Schema::hasColumn('users', 'jabatan')) {
                $table->string('jabatan')->nullable();
            }
            if (!Schema::hasColumn('users', 'jabatan_target')) {
                $table->string('jabatan_target')->nullable();
            }
            if (!Schema::hasColumn('users', 'mentor_id')) {
                $table->unsignedBigInteger('mentor_id')->nullable();
            }
            if (!Schema::hasColumn('users', 'atasan_id')) {
                $table->unsignedBigInteger('atasan_id')->nullable();
            }
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
            if (!Schema::hasColumn('users', 'foto')) {
                $table->string('foto')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

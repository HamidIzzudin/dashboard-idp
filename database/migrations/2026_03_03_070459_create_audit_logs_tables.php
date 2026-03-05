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
        Schema::create('status_log', function (Blueprint $table) {
            $table->id(); // PK id [cite: 122]
            $table->string('name_tabel'); // Key name_tabel [cite: 123]
            $table->unsignedBigInteger('record_id'); // Key record_id [cite: 126]
            $table->string('old_status')->nullable(); // Key old_status [cite: 128]
            $table->string('new_status'); // Key new_status [cite: 130]
            $table->foreignId('change_by')->constrained('users'); // FK change_by [cite: 132]
            $table->string('remark')->nullable(); // Key remark [cite: 134]
            $table->timestamps(); // created_at [cite: 136]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_log');
    }
};

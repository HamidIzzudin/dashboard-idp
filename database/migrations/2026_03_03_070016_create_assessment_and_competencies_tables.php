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
        Schema::create('competencies', function (Blueprint $table) {
            $table->id(); // PK id [cite: 145]
            $table->string('name'); // Key name [cite: 156]
            $table->string('description'); // Key description [cite: 164]
            $table->timestamps(); // created_at [cite: 171]
        });

        Schema::create('assessment', function (Blueprint $table) {
            $table->id(); // PK id [cite: 196]
            $table->foreignId('user_id_kandidat')->constrained('users'); // FK user_id(kandidat) [cite: 202]
            $table->foreignId('user_id_atasan')->constrained('users'); // FK user_id(atasan) [cite: 209]
            $table->string('period'); // Key period [cite: 212]
            $table->timestamps();
        });

        Schema::create('detail_assessment', function (Blueprint $table) {
            $table->id(); // PK id [cite: 259]
            $table->foreignId('assessment_id')->constrained('assessment'); // FK assessment_id [cite: 265]
            $table->foreignId('competence_id')->constrained('competencies'); // FK competence_id [cite: 267]
            $table->integer('score_atasan'); // Key score_atasan [cite: 270]
            $table->integer('score_kandidat'); // Key score_kandidat [cite: 273]
            $table->integer('required_score'); // Key required_score [cite: 275]
            $table->decimal('gap_score', 8, 2); // Key gap_score [cite: 277]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competencies');
        Schema::dropIfExists('assessment');
        Schema::dropIfExists('detail_assessment');
    }
};

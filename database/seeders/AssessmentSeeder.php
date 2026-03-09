<?php

// database/seeders/AssessmentSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentSeeder extends Seeder
{
    public function run(): void
    {
        // Kompetensi Master
        DB::table('competencies')->insert([
            ['id' => 1, 'name' => 'Integrity'],
            ['id' => 2, 'name' => 'Communication'],
            ['id' => 3, 'name' => 'Innovation & Creativity'],
            ['id' => 4, 'name' => 'Customer Orientation'],
            ['id' => 5, 'name' => 'Teamwork'],
            ['id' => 6, 'name' => 'Leadership'],
            ['id' => 7, 'name' => 'Business Acumen'],
            ['id' => 8, 'name' => 'Problem Solving & Decission Making'],
            ['id' => 9, 'name' => 'Acievement Orientation'],
            ['id' => 10, 'name' => 'Strategic Thinking'],
        ]);

        // Assessment Utama
        DB::table('assessment_session')->insert([
            'id' => 1,
            'user_id_talent' => 2,
            'user_id_atasan' => 1,
            'period' => '2026',
        ]);

        // Detail Assessment (Gap Analysis)
        DB::table('detail_assessment')->insert([
            [
                'assessment_id' => 1,
                'competence_id' => 1,
                'score_atasan' => 4,
                'score_talent' => 5,
                'gap_score' => -1.0,
                'notes' => 'Initial assessment notes',
            ]
        ]);
    }
}

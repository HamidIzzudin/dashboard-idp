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
            ['id' => 1, 'name' => 'Integrity', 'description' => 'Bisa Dipercaya dan Jujur'],
            ['id' => 2, 'name' => 'Communication', 'description' => 'Skill Komunikasi yang Baik'],
            ['id' => 3, 'name' => 'Innovation & Creativity', 'description' => 'Kemampuan Berinovasi dan Berpikir Kreatif'],
            ['id' => 4, 'name' => 'Customer Orientation', 'description' => 'Fokus pada Kepuasan Pelanggan'],
            ['id' => 5, 'name' => 'Teamwork', 'description' => 'Bisa Bekerja Sama dalam Tim '],
            ['id' => 6, 'name' => 'Leadership', 'description' => 'Kemampuan Memimpin'],
            ['id' => 7, 'name' => 'Business Acumen', 'description' => 'Kemampuan Memahami Bisnis dan Strategi Perusahaan'],
            ['id' => 8, 'name' => 'Problem Solving & Decission Making', 'description' => 'Kemampuan Memecahkan Masalah dan Pengambilan Keputusan yang tepat'],
            ['id' => 9, 'name' => 'Acievement Orientation', 'description' => 'Kemampuan untuk Mencapai Target dan Hasil yang Baik'],
            ['id' => 10, 'name' => 'Strategic Thinking', 'description' => 'Kemampuan Berpikir Strategis'],
        ]);

        // Assessment Utama
        DB::table('assessment')->insert([
            'id' => 1,
            'user_id_kandidat' => 2,
            'user_id_atasan' => 1,
            'period' => '2026',
        ]);

        // Detail Assessment (Gap Analysis)
        DB::table('detail_assessment')->insert([
            [
                'assessment_id' => 1,
                'competence_id' => 1,
                'score_atasan' => 4,
                'score_kandidat' => 5,
                'required_score' => 5,
                'gap_score' => -1.0,
            ]
        ]);
    }
}

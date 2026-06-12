<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            ['name' => 'Bangla', 'icon' => 'BookOpen'],
            ['name' => 'English', 'icon' => 'PenTool'],
            ['name' => 'Higher Math', 'icon' => 'Sigma'],
            ['name' => 'Physics', 'icon' => 'Atom'],
            ['name' => 'Chemistry', 'icon' => 'FlaskConical'],
            ['name' => 'Biology', 'icon' => 'Dna'],
        ];

        foreach ($subjects as $index => $subject) {
            DB::table('subjects')->insert([
                'name' => $subject['name'],
                'slug' => Str::slug($subject['name']),
                'icon' => $subject['icon'],
                'sort_order' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

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
            ['name' => 'Bangla 1st Paper', 'icon' => 'BookOpen', 'tailwind_format' => 'bg-red-50 text-red-600'],
            ['name' => 'Bangla 2nd Paper', 'icon' => 'BookOpen', 'tailwind_format' => 'bg-red-100 text-red-700'],

            ['name' => 'English 1st Paper', 'icon' => 'PenTool', 'tailwind_format' => 'bg-blue-50 text-blue-600'],
            ['name' => 'English 2nd Paper', 'icon' => 'PenTool', 'tailwind_format' => 'bg-blue-100 text-blue-700'],

            ['name' => 'Physics 1st Paper', 'icon' => 'Atom', 'tailwind_format' => 'bg-purple-50 text-purple-600'],
            ['name' => 'Physics 2nd Paper', 'icon' => 'Atom', 'tailwind_format' => 'bg-purple-100 text-purple-700'],

            ['name' => 'Chemistry 1st Paper', 'icon' => 'FlaskConical', 'tailwind_format' => 'bg-emerald-50 text-emerald-600'],
            ['name' => 'Chemistry 2nd Paper', 'icon' => 'FlaskConical', 'tailwind_format' => 'bg-emerald-100 text-emerald-700'],

            ['name' => 'Higher Math 1st Paper', 'icon' => 'Sigma', 'tailwind_format' => 'bg-amber-50 text-amber-600'],
            ['name' => 'Higher Math 2nd Paper', 'icon' => 'Sigma', 'tailwind_format' => 'bg-amber-100 text-amber-700'],

            ['name' => 'Biology 1st Paper', 'icon' => 'Dna', 'tailwind_format' => 'bg-green-50 text-green-600'],
            ['name' => 'Biology 2nd Paper', 'icon' => 'Dna', 'tailwind_format' => 'bg-green-100 text-green-700'],
        ];

        foreach ($subjects as $index => $subject) {
            DB::table('subjects')->insert([
                'name' => $subject['name'],
                'slug' => Str::slug($subject['name']),
                'icon' => $subject['icon'],
                'tailwind_format' => $subject['tailwind_format'],
                'sort_order' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

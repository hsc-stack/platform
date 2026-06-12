<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NodeSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = DB::table('subjects')->pluck('id', 'name');

        $data = [
            'Higher Math' => [
                '1st Paper' => [
                    'Matrix & Determinants',
                    'Vectors',
                    'Straight Lines',
                    'Circle',
                    'Permutations & Combinations',
                    'Trigonometric Ratios & Identities',
                    'Trigonometric Equations & Associated Angles',
                    'Functions & Graphs',
                    'Differentiation',
                    'Integration',
                ],
                '2nd Paper' => [
                    'Real Numbers & Inequalities',
                    'Polynomials',
                    'Complex Numbers',
                    'Polynomial Equations',
                    'Binomial Theorem',
                    'Conics',
                    'Inverse Trigonometric Functions & Equations',
                    'Statics',
                    'Dynamics / Motion of Particles in a Plane',
                    'Probability & Statistics (Measures of Dispersion)',
                ],
            ],

            'Physics' => [
                '1st Paper' => [
                    'Physical World & Measurement',
                    'Vectors',
                    'Motion in a Straight Line',
                    'Newtonian Mechanics',
                    'Work, Energy & Power',
                    'Gravitation',
                    'Properties of Matter',
                    'Waves',
                    'Simple Harmonic Motion',
                    'Thermodynamics',
                ],
                '2nd Paper' => [
                    'Electrostatics',
                    'Current Electricity',
                    'Magnetic Effects of Current',
                    'Electromagnetic Induction',
                    'AC Circuits',
                    'Modern Physics',
                    'Semiconductor & Electronics',
                    'Communication System',
                ],
            ],

            'Chemistry' => [
                '1st Paper' => [
                    'Qualitative Chemistry',
                    'Periodic Table & Periodicity',
                    'Chemical Bonding',
                    'Chemical Changes / Reactions',
                    'Chemistry in Our Life / Environmental Chemistry',
                ],
                '2nd Paper' => [
                    'Solid State',
                    'Solutions',
                    'Electrochemistry',
                    'Chemical Kinetics',
                    'Organic Chemistry Basics',
                    'Hydrocarbons',
                    'Alcohols, Phenols & Ethers',
                    'Aldehydes, Ketones & Carboxylic Acids',
                    'Amines',
                    'Biomolecules & Applied Chemistry',
                ],
            ],

            'Biology' => [
                '1st Paper' => [
                    'Cell Biology',
                    'Cell Division',
                    'Microorganisms',
                    'Algae & Fungi',
                    'Bryophytes & Pteridophytes',
                    'Gymnosperms & Angiosperms',
                    'Plant Physiology',
                ],
                '2nd Paper' => [
                    'Human Physiology',
                    'Blood & Circulation',
                    'Excretion & Homeostasis',
                    'Nervous System',
                    'Endocrine System',
                    'Reproduction',
                    'Genetics & Evolution',
                    'Ecology & Environment',
                ],
            ],
        ];

        $sort = 0;

        foreach ($data as $subjectName => $papers) {
            $subjectId = $subjects[$subjectName] ?? null;
            if (!$subjectId) continue;

            foreach ($papers as $paperName => $chapters) {

                $paperId = DB::table('nodes')->insertGetId([
                    'subject_id' => $subjectId,
                    'parent_id' => null,
                    'name' => $paperName,
                    'slug' => Str::slug($paperName),
                    'sort_order' => $sort++,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                foreach ($chapters as $index => $chapter) {
                    DB::table('nodes')->insert([
                        'subject_id' => $subjectId,
                        'parent_id' => $paperId,
                        'name' => $chapter,
                        'slug' => Str::slug($chapter),
                        'sort_order' => $index,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}

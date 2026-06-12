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

            'Bangla 1st Paper' => [
                'National Language Movement',
                'Poetry & Prose',
                'Grammar & Composition',
            ],

            'Bangla 2nd Paper' => [
                'Grammar Fundamentals',
                'Sentence Structure',
                'Writing Skills',
            ],

            'English 1st Paper' => [
                'Reading Comprehension',
                'Literature Texts',
                'Vocabulary Building',
            ],

            'English 2nd Paper' => [
                'Grammar Rules',
                'Writing Paragraphs',
                'Formal Letter Writing',
            ],

            'Physics 1st Paper' => [
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

            'Physics 2nd Paper' => [
                'Electrostatics',
                'Current Electricity',
                'Magnetic Effects of Current',
                'Electromagnetic Induction',
                'AC Circuits',
                'Modern Physics',
                'Semiconductor & Electronics',
                'Communication System',
            ],

            'Chemistry 1st Paper' => [
                'Qualitative Chemistry',
                'Periodic Table & Periodicity',
                'Chemical Bonding',
                'Chemical Reactions',
                'Environmental Chemistry',
            ],

            'Chemistry 2nd Paper' => [
                'Solid State',
                'Solutions',
                'Electrochemistry',
                'Chemical Kinetics',
                'Organic Chemistry Basics',
                'Hydrocarbons',
                'Alcohols, Phenols & Ethers',
                'Aldehydes, Ketones & Carboxylic Acids',
                'Amines',
                'Biomolecules',
            ],

            'Higher Math 1st Paper' => [
                'Matrix & Determinants',
                'Vectors',
                'Straight Lines',
                'Circle',
                'Permutations & Combinations',
                'Trigonometric Ratios & Identities',
                'Trigonometric Equations',
                'Functions & Graphs',
                'Differentiation',
                'Integration',
            ],

            'Higher Math 2nd Paper' => [
                'Real Numbers & Inequalities',
                'Polynomials',
                'Complex Numbers',
                'Polynomial Equations',
                'Binomial Theorem',
                'Conics',
                'Inverse Trigonometric Functions',
                'Statics',
                'Dynamics',
                'Probability & Statistics',
            ],

            'Biology 1st Paper' => [
                'Cell Biology',
                'Cell Division',
                'Microorganisms',
                'Algae & Fungi',
                'Bryophytes & Pteridophytes',
                'Gymnosperms & Angiosperms',
                'Plant Physiology',
            ],

            'Biology 2nd Paper' => [
                'Human Physiology',
                'Blood & Circulation',
                'Excretion & Homeostasis',
                'Nervous System',
                'Endocrine System',
                'Reproduction',
                'Genetics & Evolution',
                'Ecology & Environment',
            ],
        ];

        foreach ($data as $subjectName => $chapters) {

            $subjectId = $subjects[$subjectName] ?? null;
            if (!$subjectId) continue;

            foreach ($chapters as $index => $chapter) {

                DB::table('nodes')->insert([
                    'subject_id' => $subjectId,
                    'parent_id' => null,
                    'name' => $chapter,
                    'slug' => Str::slug($chapter . '-' . $subjectName),
                    'sort_order' => $index,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Domain\Admin\CoursePlans\Models\CoursePlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoursePlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoursePlan::create([
            'course_id' => 1,
            'name' => 'Reja 1'
        ]);
        CoursePlan::create([
            'course_id' => 1,
            'name' => 'Reja 2'
        ]);

        CoursePlan::create([
            'course_id' => 2,
            'name' => 'plan 1'
        ]);

        CoursePlan::create([
            'course_id' => 2,
            'name' => 'plan 2'
        ]);
    }
}

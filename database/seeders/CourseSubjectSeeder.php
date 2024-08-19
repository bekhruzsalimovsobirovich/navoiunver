<?php

namespace Database\Seeders;

use App\Domain\Admin\CourseSubjects\Models\CourseSubject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseSubject::create([
            'course_id' => 1,
            'course_plan_id' => 1,
            'name' => 'Subject 1'
        ]);

        CourseSubject::create([
            'course_id' => 1,
            'course_plan_id' => 1,
            'name' => 'Subject 2'
        ]);

        CourseSubject::create([
            'course_id' => 1,
            'course_plan_id' => 2,
            'name' => 'Subject 3'
        ]);

        CourseSubject::create([
            'course_id' => 2,
            'course_plan_id' => 1,
            'name' => 'Subject 4'
        ]);
    }
}

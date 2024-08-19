<?php

namespace Database\Seeders;

use App\Domain\Admin\Courses\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create([
            'name' => 'Php backend'
        ]);
        Course::create([
            'name' => 'ReactJs frontend'
        ]);
    }
}

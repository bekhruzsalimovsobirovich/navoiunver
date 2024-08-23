<?php

use App\Domain\Admin\CoursePlans\Models\CoursePlan;
use App\Domain\Admin\Courses\Models\Course;
use App\Domain\Admin\CourseSubjects\Models\CourseSubject;
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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Course::class)
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(CoursePlan::class)
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(CourseSubject::class)
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->dateTime('date');
            $table->boolean('status')->default(false)->comment('show to the user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};

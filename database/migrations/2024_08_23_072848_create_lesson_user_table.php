<?php

use App\Domain\Admin\Lessons\Models\Lesson;
use App\Models\User;
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
        Schema::create('lesson_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Lesson::class)
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(User::class)
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('status')->default(false)->comment('User read course subject');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_users');
    }
};

<?php

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
        Schema::create('register_courses', function (Blueprint $table) {
            $table->id();
            // Set user_id dan course_id unique untuk cegah duplikat registercourse
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('register_date')->useCurrent();
            $table->timestamps();

            $table->unique(['user_id' , 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_courses');
    }
};

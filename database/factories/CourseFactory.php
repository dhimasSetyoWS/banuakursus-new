<?php

namespace Database\Factories;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title_course' => fake()->sentence(3),
            'description' => fake()->paragraph(5),
            'price' => fake()->randomDigit(),
            'user_id' => 1,
            'period_id' => 2
        ];
    }

    protected $model = Course::class;
}

<?php

namespace Database\Factories;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
        $title = fake()->sentence(3);
        return [
            'title_course' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->paragraph(5),
            'price' => fake()->randomDigit(),
            'user_id' => 1,
            'period_id' => 2,
            'kategori_id' => fake()->randomElement([1,2,3,4,5,6,7,8]),
        ];
    }

    protected $model = Course::class;
}

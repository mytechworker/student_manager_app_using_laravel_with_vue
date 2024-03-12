<?php

namespace Database\Factories;
 
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
 
class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'username' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            // Other attributes...
        ];
    }
}
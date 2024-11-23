<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;

class StudentFactory extends Factory
{
    // Define the model that this factory corresponds to
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'name' => $this->faker->name,       // Random name
            'age' => $this->faker->numberBetween(6, 18), // Random age between 6 and 18
            'class_id' => $this->faker->numberBetween(1, 4), // Random class ID
            'class_name'=> $this->faker->randomElement(['class A','class B','class C','class D']),
            'section_id' => $this->faker->numberBetween(1, 2), // Random section ID
            'section_name'=> $this->faker->randomElement(['Section Advanced','Section Regular']),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Layout>
 */
class LayoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $x = random_int(1, 20);
        $y = random_int(1, 20);
        $emptyArray = defineArray($y, $x);
        $output = fillArray($emptyArray);

        return [
            'x' => $x,
            'y' => $y,
            'output' => $output,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\BarangCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'barang_category_id' => BarangCategory::inRandomOrder()->first()->id,
            'created_by' => 1,
        ];
    }
}

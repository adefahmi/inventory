<?php

namespace Database\Factories;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Factories\Factory;

class BarangMasukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'barang_id' => Barang::inRandomOrder()->first()->id,
            'user_id' => 1,
            'qty' => rand(1,10),
        ];
    }
}

<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Database\Seeder;

class BarangMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 20; $i++) {
            $data = [
                'barang_id' => Barang::inRandomOrder()->first()->id,
                'user_id' => 1,
                'qty' => rand(1,10),
            ];

            $barang_masuk = BarangMasuk::create($data);
            $barang_masuk->barang->increaseStock($data['qty']);
        }

    }
}

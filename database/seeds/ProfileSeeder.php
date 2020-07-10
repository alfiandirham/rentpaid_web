<?php

use Illuminate\Database\Seeder;
use App\Perusahaan;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Perusahaan::create([
            "name" => "perumnas pemda makassar",
            "alamat" => "makassar",
        ]);
    }
}

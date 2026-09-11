<?php

namespace Database\Seeders;

use App\Models\Jenis;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisList = [
            'Makanan',
            'Minuman',
            'Alat Tulis',
            'Elektronik',
            'Pakaian',
            'Kebutuhan Rumah Tangga',
        ];

        foreach ($jenisList as $nama) {
            Jenis::firstOrCreate(['nama' => $nama]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kd_jurusan' => 'JRS-001',
                'nm_jurusan' => 'Operator Komputer',
                'durasi' => '3 Bulan',
                'biaya' => 1000000,
            ],
            [
                'kd_jurusan' => 'JRS-002',
                'nm_jurusan' => 'Desain Grafis',
                'durasi' => '4 Bulan',
                'biaya' => 1200000,
            ],
            [
                'kd_jurusan' => 'JRS-003',
                'nm_jurusan' => 'Digital Marketing',
                'durasi' => '3 Bulan',
                'biaya' => 1100000,
            ],
        ];

        foreach ($data as $item) {
            Jurusan::updateOrCreate(
                ['kd_jurusan' => $item['kd_jurusan']],
                $item
            );
        }
    }
}

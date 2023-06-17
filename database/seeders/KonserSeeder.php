<?php

namespace Database\Seeders;

use App\Models\Konser;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KonserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Konser::create([
            'nama'=>'Konser aldi Taher',
            'lokasi'=>'Alun-alun ujung berung',
            'tanggal'=> now()->addDays(2),
            'jam'=>'12:00'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Konser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $konser=Konser::first();
        $data=[
            [
                'id'=>Str::uuid(),
                'konser_id'=>$konser->id,
                'nama'=>'Kelas 1',
                'kapasitas'=>3,
            ],
            [
                'id' => Str::uuid(),
                'konser_id'=>$konser->id,
                'nama'=>'Kelas 2',
                'kapasitas'=>5,
            ],
            [
                'id' => Str::uuid(),
                'konser_id'=>$konser->id,
                'nama'=>'Kelas 3',
                'kapasitas'=>2,
            ]
        ];
        Kelas::insert($data);
    }
}

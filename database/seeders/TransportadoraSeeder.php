<?php

namespace Database\Seeders;

use App\Models\Transportadora;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransportadoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transportadora::create([
            'nombre' => 'Servientrega',
            'logo' => 'servientrega.png'
        ]);
        Transportadora::create([
            'nombre' => 'Envia',
            'logo' => 'envia.png'
        ]);
        Transportadora::create([
            'nombre' => 'Interrapidisimo',
            'logo' => 'interrapidisimo.png'
        ]);
    }
}

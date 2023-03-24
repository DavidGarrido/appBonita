<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user  = User::create([
            'name' => 'Nicolas Rueda',
            'email' => 'publicidadbonita@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$5qVUgy2ptYy/79mtbNECkePhveeV0684lzk.gtrZg36iupXFJqAK6',//appBonita_2023*
            'remember_token' => Str::random(10),
        ]);
    }
}

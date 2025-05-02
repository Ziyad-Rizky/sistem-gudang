<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Barang;
use App\Models\Mutasi;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create test user
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Create sample barang data
        $barangs = Barang::factory(10)->create();

        // Create sample mutasi data
        foreach ($barangs as $barang) {
            Mutasi::factory(5)->create([
                'user_id' => $user->id,
                'barang_id' => $barang->id,
                'jenis_mutasi' => rand(0, 1) ? 'masuk' : 'keluar',
            ]);
        }
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mutasi>
 */
class MutasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'barang_id' => 1,
            'tanggal' => $this->faker->date(),
            'jenis_mutasi' => $this->faker->randomElement(['masuk', 'keluar']),
            'jumlah' => $this->faker->numberBetween(1, 100),
            'keterangan' => $this->faker->sentence,
        ];
    }
}

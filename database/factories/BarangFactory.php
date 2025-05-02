<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_barang' => $this->faker->word,
            'kode' => $this->faker->unique()->bothify('BRG-#####'),
            'kategori' => $this->faker->randomElement(['Elektronik', 'Furniture', 'Alat Tulis', 'Peralatan Dapur']),
            'lokasi' => $this->faker->randomElement(['Gudang A', 'Gudang B', 'Gudang C']),
            'deskripsi' => $this->faker->sentence,
            'stok' => $this->faker->numberBetween(0, 100),
        ];
    }
}

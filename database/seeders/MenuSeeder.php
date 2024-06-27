<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Menu::create([
            'name' => 'Esteh jeruk',
            'image' => 'Foto2.jpg',
            'description' => 'Jus jeruk segar',
            'price' => 8000,
            'status' => 'masih'
        ]);

        // Tambahkan menu untuk kategori Snack
        Menu::create([
            'name' => 'Es teh limau',
            'image' => 'Foto3.jpg',
            'description' => 'Keripik kentang renyah',
            'price' => 10000,
            'status' => 'masih'
        ]);
    }
}

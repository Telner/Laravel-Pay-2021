<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryModel = app(Category::class);

        $categoryModel->firstOrCreate(
            ['name' => 'Acao']
        );

        $categoryModel->firstOrCreate(
            ['name' => 'Aventura']
        );

        $categoryModel->firstOrCreate(
            ['name' => 'Rpg']
        );

        $categoryModel->firstOrCreate(
            ['name' => 'Estrategia']
        );

        $categoryModel->firstOrCreate(
            ['name' => 'FPS']
        );
    }
}

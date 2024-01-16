<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $validCategories = new Collection(['Small', 'Mid-sized', 'SUV', 'Motorcycles']);


        $categories = $validCategories->map(function (string $category, $index) {
            return [
                'id' => $index + 1,
                'name' => $category,
            ];
        });

        Category::upsert($categories->toArray(), ['id'], ['name']);
    }
}

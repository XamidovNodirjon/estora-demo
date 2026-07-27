<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Sotuv' => ['Kvartira', 'Hovli', 'Ofis'],
            'Ijara' => ['Kvartira', 'Hovli', 'Ofis'],
            'Xonadosh' => ['Kvartira', 'Hovli', 'Ofis'],
            'Tijorat' => ['Ofis', 'Do\'kon', 'Ombor'],
            'Dacha' => ['Dacha', 'Hovli'],
            'Xalqaro' => ['Kvartira', 'Hovli'],
        ];

        foreach ($categories as $catName => $subCats) {
            $category = Category::firstOrCreate(['name' => $catName]);

            foreach ($subCats as $subName) {
                SubCategory::firstOrCreate([
                    'category_id' => $category->id,
                    'name' => $subName,
                ]);
            }
        }
    }
}

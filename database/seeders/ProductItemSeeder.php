<?php

namespace Database\Seeders;

use App\Models\ProductItem;
use Illuminate\Database\Seeder;

class ProductItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            'Lift',
            'Balkon',
            'Parkovka',
            'Bolalar maydonchasi',
            'Kabel TV',
            'Internet',
            'Konditsioner',
            'Mebel',
        ];

        foreach ($items as $name) {
            ProductItem::firstOrCreate([
                'name' => $name,
                'product_id' => null,
            ]);
        }
    }
}

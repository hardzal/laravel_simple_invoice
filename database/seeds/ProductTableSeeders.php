<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'title' => 'Asus EROGE GAMERS!',
            'description' => 'Cocok untuk para gamers',
            'price' => 12500000,
            'stock' => 20
        ]);

        Product::create([
            'title' => 'Lenovo ThinkPad',
            'description' => 'lenovo thinks!',
            'price' => 10000000,
            'stock' => 50
        ]);
    }
}

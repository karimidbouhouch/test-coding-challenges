<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();

        for($i=1;$i<=10;$i++){
        Product::create([
            'name' => 'Product '.$i,
            'description' => 'Description of Product '.$i,
            'price' => mt_rand(000.00, 9999.99),
            'id_category' => mt_rand(1,5) ,
            'image' => 'product'.$i.'.jpg',
        ]);
        }
    }
}

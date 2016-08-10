<?php

use App\Models\Product;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $skus = [
      'SAUCE' => [
        [
          'SAU-001', 'Huy Fong Chili Garlic', 10, 100
        ],[
          'SAU-002', 'Frank\'s RedHot', 20, 90
        ],[
          'SAU-003', 'Crystal', 30, 90
        ],[
          'SAU-004', 'Cholula', 35, 85
        ],[
          'SAU-005', 'Sriracha', 40, 80
        ]
      ],
      'KNIFE' => [
        [
          'KNI-001', 'Keris', 10, 100
        ],[
          'KNI-002', 'Misericorde', 20, 90
        ],[
          'KNI-003', 'Turkana Wrist Knife', 30, 90
        ],[
          'KNI-004', 'Kujang', 35, 85
        ],[
          'KNI-005', 'Kila', 40, 80
        ]
      ],
    ];

    foreach ($skus as $category => $products) {
      foreach ($products as $product) {
        Product::create([
          'sku' => $product[0],
          'category' => $category,
          'name' => $product[1],
          'price' => $product[2],
          'stock' => $product[3],
        ]);
      }
    }

  }
}

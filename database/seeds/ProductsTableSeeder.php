<?php

use App\Product;
use App\Category;
use App\ProductImage;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //model Factory Poblacion Randomica
        // factory(Category::class,5)->create();
        // factory(Product::class,100)->create();
        // factory(ProductImage::class,200)->create();
        // Model Poblacion atraves de Relaciones

        $categories = factory(Category::class,5)->create();

        $categories->each(function($category) {
            $products = factory(Product::class,7)->make();
            $category->products()->saveMany($products);

            $products->each(function($product) {
                $images = factory(ProductImage::class,3)->make();
                $product->images()->saveMany($images);
            });

        });
    }
}

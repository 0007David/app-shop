<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'=> substr($faker->sentence(2),0,-1),
        'description'=>$faker->sentence(4),
        'long_description'=> $faker->text,
        'price'=> $faker->randomFloat(2,5,150),
        'category_id' => $faker->numberBetween(1,5)
    ];
});

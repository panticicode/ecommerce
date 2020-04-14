<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3),
        'image' => 'uploads/products/book.jpg',
        'price' => $faker->numberBetween(100, 10000),
        'description' => $faker->paragraph(4)
    ];
});

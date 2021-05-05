<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'   => $faker->text(50),
        'text'    => $faker->text(300),
        'image'   => "/storage/image/j-logo.png",
        'user_id' => function() {
            return factory(User::class);
        }
    ];
});

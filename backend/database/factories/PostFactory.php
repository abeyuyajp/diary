<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'   => 'this is title',
        'text'    => 'this is text',
        'image'   => '/storage/image/j-logo.png',
        'user_id' => function() {
            return factory(User::class);
        }
    ];
});

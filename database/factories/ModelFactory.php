<?php

$factory->define(App\Book::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'userRatingCount' => $faker->randomDigit,
        'userRating' => $faker->randomDigit,
        'criticRating' => $faker->randomDigit,
        'TAG' => $faker->word,
        'category' => $faker->word,
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        '#comment' => $faker->randomDigit,
        'comment' => $faker->text,
        'rating' => $faker->randomDigit,
    ];
});

$factory->define(App\Content::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'content' => $faker->text,
        'chapter' => $faker->randomDigit,
        'type' => $faker->word,
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'firstName' => $faker->name,
        'lastName' => $faker->name,
        'email' => $faker->safeEmail,
        'username' => $faker->word,
        'level' => $faker->randomDigit,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

<?php

use Faker\Generator as Faker;
use App\Transaction;
use App\User;
use App\Group;
use App\House;

$factory->define(Transaction::class, function (Faker $faker) {
    $house = House::all()->random();
    $group = $house->groups->random();
    $user = $group->users->random();
    return [
        'description' => $faker->sentence(),
        'amount' => $faker->numberBetween(3, 99),
        'location' => $faker->company . " " . $faker->streetName,
        'user_id' => $user->id,
        'group_id' => $group->id,
        'house_id' => $house->id
    ];
});

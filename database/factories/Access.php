<?php
/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-27,  Time: 9:22 AM */

use App\Models\Access\Role\Role;
use App\Models\Access\User\User;

/** @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\History\History::class,
    function(Faker\Generator $faker) {
        return [
            'type_id'   => getRandomClassId('App\Models\History\HistoryType'),
            'user_id'   => getRandomClassId('Access\User\User',['is_administrator','=', true]),
            'entity_id' => getRandomClassId('App\Models\Access\Role\Role'),
            'icon'      => $faker->word,
            'class'     => $faker->word,
            'text'      => $faker->word,
            'assets'    => $faker->text,
        ];
    });

$factory->define(App\Models\History\HistoryType::class,
    function(Faker\Generator $faker) {
        return [
            'name' => $faker->name,
        ];
    });

$factory->define(App\Models\Access\Permission\Permission::class,
    function(Faker\Generator $faker) {
        return [
            'name'         => $faker->name,
            'display_name' => $faker->word,
            'sort'         => $faker->randomNumber(),
        ];
    });

$factory->define(App\Models\Access\Role\Role::class,
    function(Faker\Generator $faker) {
        return [
            'name'         => $faker->name,
            'display_name' => $faker->word,
            'all'  => 0,
            'sort' => $faker->numberBetween(1, 100),
        ];
    });

$factory->state(Role::class,
    'admin',
    function() {
        return [
            'all' => 1,
        ];
    });

$factory->define(App\Models\Access\User\SocialLogin::class,
    function(Faker\Generator $faker) {
        return [
            'user_id'     => getRandomClassId('Access\User\User'),
            'provider'    => $faker->word,
            'provider_id' => $faker->word,
            'token'       => $faker->word,
            'avatar'      => $faker->word,
        ];
    });

$factory->define(User::class,
    function(Faker\Generator $faker) {
        static $password;
        $name = $faker->unique()->userName; //TODO: Remove either name or nickname

        return [
            'nickname'          => $name,
            'first_name'        => $faker->firstName,
            'last_name'         => $faker->lastName,
            'email'             => $faker->safeEmail,
            'password'          => $password ?: $password = bcrypt('secret'),
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'name'              => $name,
            'remember_token'    => str_random(10),
            // 'confirmed'         => $faker->boolean,
            // 'culture'           => $faker->languageCode,
            // 'is_administrator'  => $faker->boolean,
            // 'salutation'        => $faker->title,
            // 'status'            => $faker->boolean,
        ];
    });

$factory->state(User::class,
    'active',
    function() {
        return [
            'status' => 1,
        ];
    });

$factory->state(User::class,
    'inactive',
    function() {
        return [
            'status' => 0,
        ];
    });

$factory->state(User::class,
    'confirmed',
    function() {
        return [
            'confirmed' => 1,
        ];
    });

$factory->state(User::class,
    'unconfirmed',
    function() {
        return [
            'confirmed' => 0,
        ];
    });

$factory->defineAs(User::class,
    'super_admin',
    function(Faker\Generator $faker) use ($factory) {
        $user = $factory->raw(App\Models\Element::class);

        return array_merge($user,
            [
                'is_administrator' => true,
            ]);
    });

<?php

use Faker\Generator as Faker;

/** @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\Illuminate\Notifications\DatabaseNotification::class,
    function($faker) {
        return [
            'id'              => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'type'            => 'App\Notifications\Frontend\ReleaseWasPublished',
            'notifiable_id'   => function() {
                return auth()->id() ?: factory(\App\Models\Access\User\User::class)->create()->id;
            },
            'notifiable_type' => 'user',
            'data'            => [ 'foo' => 'bar' ]
        ];
    });

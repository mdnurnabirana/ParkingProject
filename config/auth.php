<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Authentication Guard
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication guard for your application.
    | You may change this to any of the guards defined in the guards array.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'park_users', // Changed to 'park_users' to match your provider
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Here you may define every authentication guard for your application.
    | Of course, a default configuration has been defined for you.
    |
    | Supported: "session", "token"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'park_users',
        ],
        'api' => [
            'driver' => 'token',
            'provider' => 'park_users',
            'hash' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved from your database or other storage
    | mechanisms used by your application to persist user data.
    |
    | If you have multiple user tables or models, you may configure multiple
    | sources which represent each model/table. These sources may then be
    | assigned to any extra authentication guards you have defined.
    |
    */

    'providers' => [
        'park_users' => [
            'driver' => 'eloquent',
            'model' => App\Models\ParkUser::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Reset Settings
    |--------------------------------------------------------------------------
    |
    | Here you may configure the settings for resetting passwords including
    | the default password reset provider and other settings related to
    | the password reset feature.
    |
    */

    'passwords' => [
        'park_users' => [
            'provider' => 'park_users',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Settings
    |--------------------------------------------------------------------------
    |
    | Here you may specify the number of minutes a password confirmation will
    | be remembered before the user is prompted to confirm their password again.
    |
    */

    'password_timeout' => 10800,

];

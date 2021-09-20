<?php

/*
 * You can place your custom package configuration in here.
 */
return [

    /*
    |--------------------------------------------------------------------------
    | Admin
    |--------------------------------------------------------------------------
    |
    | Set the Admin area routs prefix
    |
    */

    'path' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    |
    | Define an array of Models you want to use in the-laravel-admin-panel
    |
    */

    'models' => [
        'users' => 'App\Models\User',
        //'companies' => 'App\Models\Company',
    ],

];

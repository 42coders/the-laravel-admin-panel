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

    /*
   |--------------------------------------------------------------------------
   | Relations
   |--------------------------------------------------------------------------
   |
   | Define an array of Relation return types which will be automatically resolved in the show and edit view.
   |
   */

    'relations' => [
        'HasOne',
        'HasMany',
        'BelongsTo',
        'BelongsToMany',
        'MorphToMany',
        'MorphTo'
    ],

    /*
   |--------------------------------------------------------------------------
   | Auto Field discovery
   |--------------------------------------------------------------------------
   |
   | Define an array of Fields which should be used if no fields are defined
   |
   */

    'autofields' => [
        'type' => [
            'tinyint(1)' => 'the42coders\TLAP\Fields\CheckboxField',
            'text' => 'the42coders\TLAP\Fields\TrixField',
            'timestamp' => 'the42coders\TLAP\Fields\TimeStampField',
            'datetime' => 'the42coders\TLAP\Fields\TimeStampField',
            'bigint' => 'the42coders\TLAP\Fields\NumberField',
            'bigint unsigned' => 'the42coders\TLAP\Fields\NumberField',
        ],
        'name' => [
            'pw' => 'the42coders\TLAP\Fields\PasswordField',
            'password' => 'the42coders\TLAP\Fields\PasswordField',
        ],
    ],

    'datatableFilter' => [
        'type' => [
            'text' => 'the42coders\TLAP\Filters\ShortenTextFilter',
            'timestamp' => 'the42coders\TLAP\Filters\FormatTimestamps',
            'datetime' => 'the42coders\TLAP\Filters\FormatTimestamps',
        ],
    ],

];

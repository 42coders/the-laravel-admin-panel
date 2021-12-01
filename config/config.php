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
            'tinyint(1)' => \the42coders\TLAP\Fields\CheckboxField::class,
            'text' => \the42coders\TLAP\Fields\TrixField::class,
            'timestamp' => \the42coders\TLAP\Fields\TimeStampField::class,
            'datetime' => \the42coders\TLAP\Fields\TimeStampField::class,
            'bigint' => \the42coders\TLAP\Fields\NumberField::class,
            'bigint unsigned' => \the42coders\TLAP\Fields\NumberField::class,
        ],
        'name' => [
            'id' => \the42coders\TLAP\Fields\ReadOnlyField::class,
            'created_at' => \the42coders\TLAP\Fields\ReadOnlyField::class,
            'updated_at' => \the42coders\TLAP\Fields\ReadOnlyField::class,
            'deleted_at' => \the42coders\TLAP\Fields\ReadOnlyField::class,
            'pw' => \the42coders\TLAP\Fields\PasswordField::class,
            'password' => \the42coders\TLAP\Fields\PasswordField::class,
        ],
    ],

    'datatableFilter' => [
        'type' => [
            'text' => \the42coders\TLAP\Filters\ShortenTextFilter::class,
            'timestamp' => \the42coders\TLAP\Filters\FormatTimestamps::class,
            'datetime' => \the42coders\TLAP\Filters\FormatTimestamps::class,
        ],
    ],

    'datatableDontDisplay' => [
        'type' => ['text'],
        'name' => ['deleted_at'],
    ],

];

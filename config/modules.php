<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Configuration
    |--------------------------------------------------------------------------
    |
    |
    |
    */

    'default' => [

        /*
        |--------------------------------------------------------------------------
        | Directory
        |--------------------------------------------------------------------------
        |
        | Default directory 'Modules'
        |
        */

        'directory' => 'Modules',

        /*
        |--------------------------------------------------------------------------
        | Type Of Routing
        |--------------------------------------------------------------------------
        |
        | If you need / don't need different route files for web and api
        | you can change the array entries like you need them.
        |
        | Supported: "web", "api", "simple"
        |
        */

        'routing' => ['web', 'api'],

        /*
        |--------------------------------------------------------------------------
        | Module Structure
        |--------------------------------------------------------------------------
        |
        | In case your desired module structure differs
        | from the default structure defined here
        | feel free to change it the way you like it,
        |
        */

        'structure' => [
            'controllers' => 'Controllers',
            'resources' => 'Transformers',
            'requests' => 'Requests',
            'models' => 'Models',
            'mails' => 'Mail',
            'notifications' => 'Notifications',
            'events' => 'Events',
            'listeners' => 'Listeners',
            'observers' => 'Observers',
            'jobs' => 'Jobs',
            'views' => 'Resources/views',
            'translations' => 'Resources/lang',
            'routes' => 'routes',
            'migrations' => 'database/migrations',
            'seeds' => 'database/seeds',
            'factories' => 'database/factories',
            'helpers' => '',
            'filters' => 'Filters',
            'traits' => 'Traits',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Module Specific Configuration
    |--------------------------------------------------------------------------
    |
    | In the "specific" config you can disable individual modules
    | and override every "default" config from above
    | The array key needs to be the module name.
    |
    */

    'specific' => [

        /*
        |--------------------------------------------------------------------------
        | Example Module
        |--------------------------------------------------------------------------
        |
        |
        | 'ExampleModule' => [
        |     'enabled' => false,
        |     'routing' => [ 'simple' ],
        |     'structure' => [
        |         'controllers' => 'Controllers',
        |         'views' => 'Views',
        |         'translations' => 'Translations',
        |     ],
        | ],
        */

    ],
];

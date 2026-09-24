<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Paths
    |--------------------------------------------------------------------------
    |
    | This is the location where all of your Blade templates reside. These
    | directories are searched by the view finder whenever a view is asked
    | for by name, for example "layouts.app".
    |
    */

    'paths' => [
        resource_path('views'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Paths
    |--------------------------------------------------------------------------
    |
    | This is the path where the compiled Blade templates are stored. The
    | directory must be writable by your web server process. By default,
    | the framework stores compiled templates under storage/framework.
    |
    */

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ),

];

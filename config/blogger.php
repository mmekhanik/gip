<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Articles Render Type
    |--------------------------------------------------------------------------
    |
    | You can specify how would you like to display your articles
    |
    | Supported: "single", "multiple"
    |
     */
    'articles_render_type' => 'single',

    /*
    |--------------------------------------------------------------------------
    | Filemanager path to images
    |--------------------------------------------------------------------------
    |
    |
     */
    'filemanager' => [
        'upload_path' => 'storage/photos',
    ],

      /*
    |--------------------------------------------------------------------------
    | albums path to images
    |--------------------------------------------------------------------------
    |
    |
     */
    'albummanager' => [
        'upload_path' => 'storage/images/albums',
    ],

    /*
    |--------------------------------------------------------------------------
    | Articles per page
    |--------------------------------------------------------------------------
    |
    |
     */

    'articles_per_page' => '10',

    /*
    |--------------------------------------------------------------------------
    | Article layout
    |--------------------------------------------------------------------------
    |
    | Defines layout of the article
    |
     */
    'article_layout' => 'layouts.frontend',

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode
    |--------------------------------------------------------------------------
    |
    | Defines excluded ips for the maintenance mode (your computer ip)
    |
     */
    'maintenace_mode' => [
        'excluded_ips' => [
            '192.168.0.108',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Email
    |--------------------------------------------------------------------------
    |
    | Defines admin email for contact form notifications
    |
     */
    'admin_email' => 'gipirioninfo@gmail.com',

    /*
    |--------------------------------------------------------------------------
    | Search engine
    |--------------------------------------------------------------------------
    |
    | You can specify whether your support search
    |
    | Supported: "ElasticSearch"
    |
     */
    'search_engine' => [
        'enabled' => false,
        'searchable' => [
            "App\\Models\\Article",
        ],
    ],

    'search' => [
        'enabled' => env('ELASTICSEARCH_ENABLED', false),
        'hosts' => explode(',', env('ELASTICSEARCH_HOST')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Auth
    |--------------------------------------------------------------------------
    |
    | You can specify your successful redirect path
    |
    |
     */
    'auth' => [
        'success' => 'dashboard',
        'impersonification' => [
            'session_name' => 'back_to_admin',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Social login
    |--------------------------------------------------------------------------
    |
    | You can specify whether your support social logins
    |
    |
     */
    'social_login' => [
        'enabled' => true,
        'providers' => [
            'facebook' => [
                'enabled' => true,
            ],
            'twitter' => [
                'enabled' => true,
            ],
            'google' => [
                'enabled' => true,
            ],
        ],

    ],
    'github_repository' => 'gip',
    'url' =>'https://github.com/mmekhanik/gip',

];

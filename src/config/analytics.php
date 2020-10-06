<?php

return [
    'report' => env('ANALYTICS_REPORT'),

    'tagmanager' => env('ANALYTICS_TAGMANAGER'),

    'view_id' => env('ANALYTICS_VIEW_ID'),

    'service_account_credentials_json' => storage_path('app/analytics/service-account-credentials.json'),

    'cache_lifetime_in_minutes' => 60 * 24,

    'cache' => [
        'store' => 'redis',
    ],
];

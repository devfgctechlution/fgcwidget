<?php

return [
    'namespace' => 'FGCQuickWeb',
    'stubs' => [
        'enabled' => false,
        'path' => base_path('vendor/fgcquickweb/laravel-widgets/src/Commands/stubs'),
        'files' => [
        ],
        'replacements' => [
        ]
    ],
    'paths' => [
        'widgets' => base_path('FGCWidgets'),
        'generator' => [
            'views' => ['path' => 'Resources/views',],
            'assets' => ['path' => 'Resources/assets', 'generate' => true],
            'lang' => ['path' => 'Resources/lang', 'generate' => true],
        ]
    ],
    'composer' => [
        'vendor' => 'fgcquickweb',
        'author' => [
            'name' => 'Hoang Bien',
            'email' => 'hoangbien264@gmail.com',
        ],
        'composer-output' => false,
    ]
];


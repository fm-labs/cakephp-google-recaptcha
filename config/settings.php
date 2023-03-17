<?php
return [
    'Settings' => [
        'GoogleRecaptcha' => [
            'groups' => [
                'GoogleRecaptcha' => [
                    'label' => __d('google_recaptcha', 'Google Recaptcha'),
                ],
            ],

            'schema' => [
                'GoogleRecaptcha.siteKey' => [
                    'group' => 'GoogleRecaptcha',
                    'type' => 'string',
                    'help' => 'Your sitekey.',
                    'default' => null,
                    //5'required' => true,
                ],
            ],
        ],
    ],
];

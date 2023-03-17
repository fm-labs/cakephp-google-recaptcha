<?php
return [
    'GoogleRecaptcha' => [
        'enabled' => true,
        'type' => 'v2',
        'siteKey' => null,
        'secretKey' => null,
        // 'locale' => null,            // Defaults to I18n::getLocale()
        // 'theme' => 'light',          // Optional. The color theme of the widget. [dark|light]
        // 'size' => 'normal',          // Optional. The size of the widget. [normal|compact]
        // 'tabindex' => 0,             // Optional. The tabindex of the widget and challenge. If other elements in your page use tabindex, it should be set to make user navigation easier.
        // 'callback' => null,          // Optional. The name of your callback function, executed when the user submits a successful response. The g-recaptcha-response token is passed to your callback.
        // 'expired-callback' => null,  // Optional. The name of your callback function, executed when the reCAPTCHA response expires and the user needs to re-verify.
        // 'error-callback' => null,    // Optional. The name of your callback function, executed when reCAPTCHA encounters an error (usually network connectivity) and cannot continue until connectivity is restored. If you specify a function here, you are responsible for informing the user that they should retry.

    ]
];

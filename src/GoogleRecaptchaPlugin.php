<?php

namespace GoogleRecaptcha;

use Cake\Core\BasePlugin;
use Cake\Core\Configure;
use Cake\Core\PluginApplicationInterface;
use Cake\Log\Engine\FileLog;
use Cake\Log\Log;

class GoogleRecaptchaPlugin extends BasePlugin
{
    public function bootstrap(PluginApplicationInterface $app): void
    {
        if (!Log::getConfig('google_recaptcha')) {
            /**
             * Logs
             */
            \Cake\Log\Log::setConfig('google_recaptcha', [
                'className' => FileLog::class,
                'path' => LOGS,
                'file' => 'google_recaptcha',
                //'levels' => ['info'],
                'scopes' => ['captcha', 'google_recaptcha']
            ]);
        }

        /**
         * Load default content config
         */
        Configure::load('GoogleRecaptcha.google_recaptcha');

        if (\Cake\Core\Plugin::isLoaded('Settings')) {
            Configure::load('GoogleRecaptcha', 'settings');
        }
    }
}
<?php

namespace GoogleRecaptcha\View\Helper;

use Cake\Core\Configure;
use Cake\I18n\I18n;
use Cake\View\Helper;
use GoogleRecaptcha\View\Widget\Recaptcha2CheckboxWidget;

/**
 * Class Recaptcha helper
 *
 * @property \Cake\View\Helper\HtmlHelper $Html
 * @property \Cake\View\Helper\FormHelper $Form
 */
class RecaptchaHelper extends Helper
{
    public $helpers = ['Html', 'Url', 'Form'];

    public $_defaultConfig = [
        'scriptUrl' => 'https://www.google.com/recaptcha/api.js',
        //'type' => 'v2',
        'locale' => null,
    ];

    /**
     * {@inheritDoc}
     */
    public function initialize(array $config): void
    {
        //$this->setConfig(Configure::read('GoogleRecaptcha'));
        $locale = $this->getConfig('locale', I18n::getLocale());

        $this->Form->addWidget('recaptcha2', [Recaptcha2CheckboxWidget::class, '_view']);
        $this->Html->script($this->getConfig('scriptUrl') . '?hl=' . $locale, ['block' => true]);
    }

    /**
     * Render recaptcha html
     *
     * @return string
     */
    public function checkbox()
    {
//        $siteKey = $this->getConfig('siteKey');
//        $html = "";
//        if (!$siteKey && Configure::read('debug')) {
//            $html .= $this->Html->div('alert alert-warning', "!!! NO GOOGLE CAPTCHA SITEKEY CONFIGURED !!!");
//        }
//
//        $html .= $this->Html->div('g-recaptcha', '', [
//            'data-sitekey' => $this->getConfig('siteKey')
//        ]);
//
//        return $html;
        return $this->Form->control('captcha', ['type' => 'recaptcha2']);
    }
}

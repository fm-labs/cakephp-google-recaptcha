<?php

namespace GoogleRecaptcha\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

/**
 * Class Recaptcha helper
 *
 * @property \Cake\View\Helper\HtmlHelper $Html
 * @property \Cake\View\Helper\FormHelper $Form
 */
class RecaptchaHelper extends Helper
{
    public $helpers = ['Html', 'Form'];

    public $_defaultConfig = [
        'scriptUrl' => 'https://www.google.com/recaptcha/api.js',
        'type' => 'v2',
        'siteKey' => ''
    ];

    /**
     * {@inheritDoc}
     */
    public function initialize(array $config)
    {
        $this->config(Configure::read('GoogleRecaptcha'));

        $this->Form->addWidget('recaptcha', ['GoogleRecaptcha\View\Widget\Recaptcha2CheckboxWidget', '_view']);
        $this->Html->script($this->config('scriptUrl'), ['block' => true]);
    }

    /**
     * Render recaptcha html
     *
     * @return string
     */
    public function checkbox()
    {
        return $this->Html->div('g-recaptcha', '', ['data-sitekey' => $this->config('siteKey')]);
    }
}

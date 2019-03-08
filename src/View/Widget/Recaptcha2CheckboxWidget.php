<?php

namespace GoogleRecaptcha\View\Widget;

use Cake\Core\Configure;
use Cake\View\Form\ContextInterface;
use Cake\View\View;
use Cake\View\Widget\BasicWidget;

/**
 * class Recaptcha2CheckboxWidget
 */
class Recaptcha2CheckboxWidget extends BasicWidget
{
    /**
     * @var View
     */
    protected $_View;

    /**
     * {@inheritDoc}
     */
    public function __construct($templates, View $view)
    {
        parent::__construct($templates);

        $this->_templates->add([
            'recaptcha_container' => '<div{{attrs}}></div>'
        ]);

        $this->_View = $view;
    }

    /**
     * {@inheritDoc}
     */
    public function render(array $data, ContextInterface $context)
    {
        // captcha container
        $captchaHtml = $this->_templates->format('recaptcha_container', [
            'attrs' => $this->_templates->formatAttributes([
                'class' => 'g-recaptcha',
                'data-sitekey' => Configure::read('GoogleRecaptcha.siteKey')
            ]),
        ]);

        return $captchaHtml;
    }

    /**
     * {@inheritDoc}
     */
    public function secureFields(array $data)
    {
        return ['g-recaptcha-response'];
    }
}

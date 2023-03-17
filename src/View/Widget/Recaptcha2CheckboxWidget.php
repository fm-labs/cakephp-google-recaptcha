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
    protected View $_View;

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
    public function render(array $data, ContextInterface $context): string
    {
        $siteKey = Configure::read('GoogleRecaptcha.siteKey');
        if (!$siteKey) {
            if (Configure::read('debug')) {
                return $this->_View->Html->div('alert alert-warning', "No Google Recaptcha siteKey configured");
            }
            return $this->_View->Html->div('alert alert-warning', __("Captcha service is currently not available"));
        }

        // captcha container
        $captchaHtml = $this->_templates->format('recaptcha_container', [
            'attrs' => $this->_templates->formatAttributes([
                'class' => 'g-recaptcha',
                'data-sitekey' => Configure::read('GoogleRecaptcha.siteKey', ''),
                'data-theme' => Configure::read('GoogleRecaptcha.theme', 'light'),
                'data-size' => Configure::read('GoogleRecaptcha.size', 'normal'),
            ]),
        ]);

        $data['id'] = uniqid('recaptcha_input');
        $data['name'] = 'captcha';
        $data['type'] = 'hidden';
        $data['val'] = 'g-recaptcha2';
        $input = parent::render($data, $context);

        return $input . $captchaHtml;
    }

    /**
     * {@inheritDoc}
     */
    public function secureFields(array $data): array
    {
        return ['g-recaptcha-response'];
    }
}

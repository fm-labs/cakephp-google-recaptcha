<?php

namespace GoogleRecaptcha\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\Event\Event;

class RecaptchaComponent extends Component
{
    public $components = ['Flash'];

    /**
     * @param Event $event The event object
     * @return void
     */
    public function startup(Event $event)
    {
        if (Configure::read('GoogleRecaptcha.enabled') == true) {
            $checkActions = (array)$event->subject()->captchaActions;
            if ($this->request->is(['put', 'post']) && in_array($this->request->param('action'), $checkActions)) {
                if (!$this->request->data('g-recaptcha-response')) {
                    $event->subject()->Flash->error('Invalid captcha', ['key' => 'auth']);
                    //$event->subject()->redirect(['action' => $this->request->param('action')]);
                }
            }
        }
    }
}

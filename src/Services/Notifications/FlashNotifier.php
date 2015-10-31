<?php

namespace Ss\Services\Notifications;

use Illuminate\Session\Store;
use Illuminate\Support\MessageBag;

class FlashNotifier
{
    /**
     * @var \Illuminate\Session\Store
     */
    protected $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function success($message)
    {
        $this->message($message, 'success');
    }

    public function error($message)
    {
        $this->message($message, 'danger');
    }

    public function validation(MessageBag $errors, $message = 'Form validation failed')
    {
        $this->error($message);
        $this->session->flash('flash_notification.validation', $errors->getMessages());
    }

    public function message($message, $level = 'info')
    {
        $this->session->flash('flash_notification.message', $message);
        $this->session->flash('flash_notification.level', $level);
    }
}

<?php
namespace Ss\Mailers;

use Illuminate\Mail\Mailer as Mail;
use Ss\Repositories\User\User;

abstract class Mailer
{

    /**
     * @var \Illuminate\Mail\Mailer
     */
    protected $mailer;

    /**
     * @param Mail $mailer
     */
    function __construct(Mail $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Sends an email to a user
     *
     * @param User $user
     * @param $subject
     * @param $view
     * @param array $data
     */
    public function sendTo(User $user, $subject, $view, $data = [])
    {
        $this->mailer->queue($view, $data, function($message) use ($user, $subject)
        {
            $message->to($user->email)->subject($subject);
        });
    }
} 
<?php
namespace Ss\Listeners;

use Laracasts\Commander\Events\EventListener;
use Ss\Domain\Song\Events\SongSuggested;
use Ss\Mailers\SongMailer;
use Ss\Repositories\User\UserInterface;

class EmailNotifier extends EventListener
{
    protected $mailer;
    protected $user;

    function __construct(SongMailer $mailer, UserInterface $user)
    {
        $this->mailer = $mailer;
        $this->user = $user;
    }

    public function whenSongSuggested(SongSuggested $event)
    {
        $suggester = $event->song->user;

        $users = $this->user->getAllEmailableUsers($suggester->id);

        foreach($users as $user) {
            $this->mailer->sendSongAddedEmailTo($user, $event->song, $suggester);
        }
    }
} 
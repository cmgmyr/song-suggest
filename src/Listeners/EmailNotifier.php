<?php
namespace Ss\Listeners;

use Laracasts\Commander\Events\EventListener;
use Ss\Domain\Activity\Events\ActivityAdded;
use Ss\Domain\Comment\Events\CommentPublished;
use Ss\Domain\Song\Events\SongCategoryChanged;
use Ss\Domain\Song\Events\SongSuggested;
use Ss\Domain\User\Events\UsersVoteNotification;
use Ss\Mailers\SongMailer;
use Ss\Repositories\Song\SongInterface;
use Ss\Repositories\User\UserInterface;

class EmailNotifier extends EventListener
{

    /**
     * @var SongInterface
     */
    protected $song;

    /**
     * @var SongMailer
     */
    protected $mailer;

    /**
     * @var UserInterface
     */
    protected $user;

    function __construct(SongInterface $song, SongMailer $mailer, UserInterface $user)
    {
        $this->song = $song;
        $this->mailer = $mailer;
        $this->user = $user;
    }

    /**
     * Sends an email when a song was suggested
     *
     * @param SongSuggested $event
     */
    public function whenSongSuggested(SongSuggested $event)
    {
        $suggester = $event->song->user;

        $users = $this->user->getAllEmailableUsers($suggester->id);

        foreach ($users as $user) {
            $this->mailer->sendSongAddedEmailTo($user, $event->song, $suggester);
        }
    }

    /**
     * Sends an email when an activity is added to a song
     *
     * @param ActivityAdded $event
     */
    public function whenActivityAdded(ActivityAdded $event)
    {
        $song = $this->song->deletedWithId($event->activity->song_id);
        $followers = $song->getFollowers($event->activity->user_id);

        $activityMadeBy = $this->user->byId($event->activity->user_id);
        $notification = $activityMadeBy->first_name . ' ' . $event->activity->message;

        foreach ($followers as $follower) {
            $user = $this->user->byId($follower->user->id);
            $this->mailer->sendSongActivityTo($user, $song, $notification);
        }
    }

    /**
     * Sends an email when a comment was left on a song
     *
     * @param CommentPublished $event
     */
    public function whenCommentPublished(CommentPublished $event)
    {
        $song = $this->song->deletedWithId($event->comment->song_id);
        $followers = $song->getFollowers($event->comment->user_id);

        $commendMadeBy = $this->user->byId($event->comment->user_id);
        $notification = $commendMadeBy->first_name . ' said: ' . $event->comment->comment;

        foreach ($followers as $follower) {
            $user = $this->user->byId($follower->user->id);
            $this->mailer->sendSongActivityTo($user, $song, $notification);
        }
    }

    /**
     * Sends an email when a song category has changed
     *
     * @param SongCategoryChanged $event
     */
    public function whenSongCategoryChanged(SongCategoryChanged $event)
    {
        $song = $event->song;
        $newCategory = $song->category->name;
        $followers = $song->getFollowers();

        $notification = 'This song has been moved to "' . $newCategory . '"';

        foreach ($followers as $follower) {
            $user = $this->user->byId($follower->user->id);
            $this->mailer->sendSongActivityTo($user, $song, $notification);
        }
    }

    /**
     * Sends emails to users that need to vote for a song
     *
     * @param UsersVoteNotification $event
     */
    public function whenUsersVoteNotification(UsersVoteNotification $event)
    {
        $song = $event->song;
        $users = $event->users;

        $notification = 'We noticed that you haven\'t cast a vote for "' . $song->title . '" yet. Please to go the song to vote.';

        foreach ($users as $user) {
            $user = $this->user->byId($user->id);
            $this->mailer->sendVoteReminder($user, $song, $notification);
        }
    }
} 
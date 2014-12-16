<?php
namespace Ss\Mailers;

use Ss\Repositories\Song\Song;
use Ss\Repositories\User\User;

class SongMailer extends Mailer
{
    /**
     * Notifies a user if a new song has been added
     *
     * @param User $user
     * @param Song $song
     * @param User $suggester
     */
    public function sendSongAddedEmailTo(User $user, Song $song, User $suggester)
    {
        $subject = '"' . $song->title . '" has been suggested.';
        $view = 'emails.songs.suggestion';

        $data = [
            'user_first_name'      => $user->first_name,
            'song_id'              => $song->id,
            'song_title'           => $song->title,
            'song_artist'          => $song->artist,
            'suggester_first_name' => $suggester->first_name
        ];

        $this->sendTo($user, $subject, $view, $data);
    }

    /**
     * Notifies a user if there is new activity on a song
     *
     * @param User $user
     * @param Song $song
     * @param $notification
     */
    public function sendSongActivityTo(User $user, Song $song, $notification)
    {
        $subject = '"' . $song->title . '" has new activity.';
        $view = 'emails.songs.activity';

        $data = [
            'user_first_name' => $user->first_name,
            'song_id'         => $song->id,
            'song_title'      => $song->title,
            'song_artist'     => $song->artist,
            'notification'    => $notification
        ];

        $this->sendTo($user, $subject, $view, $data);
    }

    /**
     * Notifies a user if they haven't voted for a song yet
     *
     * @param User $user
     * @param Song $song
     * @param $notification
     */
    public function sendVoteReminder(User $user, Song $song, $notification)
    {
        $subject = 'Please vote for "' . $song->title . '".';
        $view = 'emails.songs.vote-reminder';

        $data = [
            'user_first_name' => $user->first_name,
            'song_id'         => $song->id,
            'song_title'      => $song->title,
            'song_artist'     => $song->artist,
            'notification'    => $notification
        ];

        $this->sendTo($user, $subject, $view, $data);
    }
}

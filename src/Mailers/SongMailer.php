<?php
namespace Ss\Mailers;

use Ss\Repositories\Song\Song;
use Ss\Repositories\User\User;

class SongMailer extends Mailer
{

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
} 
<?php
namespace Ss\Controllers;

use Illuminate\Support\Facades\View;
use Ss\Repositories\Song\Song;
use Ss\Repositories\User\User;

class EmailsController extends BaseController
{

    public function suggest()
    {
        $user = User::find(5);
        $song = Song::find(1);
        $suggester = $song->user;

        $data = [
            'user_first_name'      => $user->first_name,
            'song_id'              => $song->id,
            'song_title'           => $song->title,
            'song_artist'          => $song->artist,
            'suggester_first_name' => $suggester->first_name
        ];

        return View::make('emails.songs.suggestion', $data);
    }

    public function activity()
    {
        $user = User::find(5);
        $song = Song::find(1);
        $notification = 'Another User voted "Yes" for this song.';

        $data = [
            'user_first_name' => $user->first_name,
            'song_id'         => $song->id,
            'song_title'      => $song->title,
            'song_artist'     => $song->artist,
            'notification'    => $notification
        ];

        return View::make('emails.songs.activity', $data);
    }

    public function password()
    {
        $data = [
            'token' => md5('abc123')
        ];

        return View::make('emails.auth.reminder', $data);
    }
} 
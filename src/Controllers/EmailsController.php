<?php
namespace Ss\Controllers;

use Illuminate\Support\Facades\View;
use Ss\Repositories\Song\Song;
use Ss\Repositories\User\User;

class EmailsController extends BaseController
{
    /**
     * @var string
     */
    protected $layout = 'emails.layouts.basic';

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

        $this->layout->content = View::make('emails.songs.suggestion', $data);
    }
} 
<?php

namespace Ss\Controllers\Api;

use Illuminate\Support\Facades\Input;
use Ss\Controllers\BaseController;
use Ss\Repositories\Song\SongInterface;

class BandsController extends BaseController
{
    /**
     * @var \Ss\Repositories\Song\SongInterface
     */
    protected $song;

    public function __construct(SongInterface $song)
    {
        $this->song = $song;
    }

    /**
     * Shows all of the unique artist names.
     */
    public function index()
    {
        $query = Input::get('q');
        $bands = $this->song->getArtistsApi($query);
        $return = [];

        foreach ($bands as $band) {
            $return[] = $band->artist;
        }

        return \Response::json(['data' => $return]);
    }
}

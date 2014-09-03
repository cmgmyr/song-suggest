<?php namespace Ss\Controllers;

use Ss\Domain\Vote\VoteCastCommand;

class VotesController extends BaseController
{

    /**
     * Store a newly created resource in storage.
     * POST /votes
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /votes/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /votes/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Adds a new vote for the song that was just suggested
     *
     * @param $event
     */
    public function whenSongWasSuggested($event)
    {
        $input = ['song_id' => $event->song->id, 'user_id' => $event->song->user_id, 'vote' => 'y'];
        $this->execute(VoteCastCommand::class, $input);
    }

}
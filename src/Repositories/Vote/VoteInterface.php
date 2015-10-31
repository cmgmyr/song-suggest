<?php

namespace Ss\Repositories\Vote;

interface VoteInterface
{
    /**
     * Fetches all votes from data source.
     *
     * @return object
     */
    public function all();

    /**
     * Fetches and returns vote data associated with an id.
     *
     * @param $id
     * @return object
     * @throws VoteNotFoundException
     */
    public function byId($id);

    /**
     * Accept new vote data that will be persisted in data source.
     *
     * @param Vote $vote
     * @return \Ss\Repositories\Vote\Vote
     * @throws VoteNotSavedException
     */
    public function save(Vote $vote);

    /**
     * Removes a vote from data source.
     *
     * @param Vote $vote
     * @internal param $id
     * @return boolean
     */
    public function delete(Vote $vote);
}

<?php
namespace Ss\Repositories\Vote;

use Illuminate\Database\Eloquent\Model;

class EloquentVote implements VoteInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $vote;

    function __construct(Model $vote)
    {
        $this->vote = $vote;
    }

    /**
     * Fetches all votes from data source
     *
     * @return object
     */
    public function all()
    {
        return $this->vote->all();
    }

    /**
     * Fetches and returns vote data associated with an id
     *
     * @param $id
     * @return object
     * @throws VoteNotFoundException
     */
    public function byId($id)
    {
        $vote = $this->vote->find($id);
        if (!$vote) {
            throw new VoteNotFoundException('No vote found with ID: ' . $id);
        }

        return $vote;
    }

    /**
     * Accept new vote data that will be persisted in data source
     *
     * @param Vote $vote
     * @return \Ss\Repositories\Vote\Vote
     * @throws VoteNotSavedException
     */
    public function save(Vote $vote)
    {
        $vote->save();

        if (!$vote->id) {
            throw new VoteNotSavedException('The vote was not saved.');
        }

        return $vote;
    }

    /**
     * Removes a vote from data source
     *
     * @param Vote $vote
     * @return boolean
     */
    public function delete(Vote $vote)
    {
        $vote->delete();

        return true;
    }
} 
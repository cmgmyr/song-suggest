<?php

namespace Ss\Workers;

use Illuminate\Support\Facades\Config;
use Laracasts\Commander\CommanderTrait;
use Ss\Domain\Song\SongCategoryChangedCommand;
use Ss\Repositories\Category\Category;
use Ss\Repositories\Song\SongInterface;

class UpdateSongCategories
{
    use CommanderTrait;

    /**
     * @var SongInterface
     */
    protected $song;

    public function __construct(SongInterface $song)
    {
        $this->song = $song;
    }

    /**
     * Recalculates the song categories.
     *
     * @param $job
     * @param $data
     */
    public function fire($job, $data)
    {
        // @todo: This method copies a lot of functionality from VotesController@whenVoteWasCast - find a better way to handle

        // get threshold
        $threshold = Config::get('settings.threshold');

        $songs = $this->song->all();
        if ($songs) {
            foreach ($songs as $song) {
                // find the positive votes
                $positiveVotes = $song->positiveVotes();

                // find negative votes
                $negativeVotes = $song->negativeVotes();

                // see if song is negative or positive, then move to category
                if (!in_array($song->category_id, Category::getProtectedCategories())) {
                    if ($positiveVotes >= $threshold) {
                        $input = ['song' => $song, 'category_id' => Category::APPROVED];
                        $this->execute(SongCategoryChangedCommand::class, $input);
                    } elseif ($negativeVotes >= $threshold) {
                        $input = ['song' => $song, 'category_id' => Category::DECLINED];
                        $this->execute(SongCategoryChangedCommand::class, $input);
                    } else {
                        $input = ['song' => $song, 'category_id' => Category::PENDING];
                        $this->execute(SongCategoryChangedCommand::class, $input);
                    }
                }
            }
        }
    }
}

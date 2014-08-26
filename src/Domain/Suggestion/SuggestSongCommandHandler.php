<?php
namespace Ss\Domain\Suggestion;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Ss\Repositories\Song\Song;
use Ss\Repositories\Song\SongInterface;

class SuggestSongCommandHandler implements CommandHandler
{
    use DispatchableTrait;
    /**
     * @var \Ss\Repositories\Song\SongInterface
     */
    protected $song;

    function __construct(SongInterface $song)
    {
        $this->song = $song;
    }

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $song = Song::suggest($command->artist, $command->title, $command->user->id);

        $this->song->save($song);

        $this->dispatchEventsFor($song);

        return $song;
    }
}
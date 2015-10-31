<?php

namespace Ss\Domain\Song;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Ss\Repositories\Song\Song;
use Ss\Repositories\Song\SongInterface;

class DeleteSongCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    /**
     * @var SongInterface
     */
    protected $song;

    public function __construct(SongInterface $song)
    {
        $this->song = $song;
    }

    /**
     * Handle the command.
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $song = Song::deleteSong($command->song, $command->editor);

        $this->song->delete($song);

        $this->dispatchEventsFor($song);

        return $song;
    }
}

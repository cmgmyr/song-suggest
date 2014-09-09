<?php
namespace Ss\Domain\Song;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Ss\Repositories\Song\Song;
use Ss\Repositories\Song\SongInterface;

class RestoreSongCommandHandler implements CommandHandler
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
        $song = Song::RestoreSong($command->song, $command->editor);

        $this->song->restore($song);

        $this->dispatchEventsFor($song);

        return $song;
    }
}
<?php

namespace Ss\Domain\Song;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Ss\Repositories\Song\Song;
use Ss\Repositories\Song\SongInterface;

class EditSongCommandHandler implements CommandHandler
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
        $song = Song::edit($command->song, $command->editor, $command->artist, $command->title, $command->youtube, $command->mp3_file);

        $this->song->save($song);

        $this->dispatchEventsFor($song);

        return $song;
    }
}

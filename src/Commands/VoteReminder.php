<?php

namespace Ss\Commands;

use Illuminate\Support\Facades\Config;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use Laracasts\Commander\Events\DispatchableTrait;
use Laracasts\Commander\Events\EventGenerator;
use Ss\Domain\User\Events\UsersVoteNotification;
use Ss\Repositories\Song\Song;
use Ss\Repositories\Song\SongInterface;
use Ss\Repositories\User\UserInterface;

class VoteReminder extends ScheduledCommand
{
    use DispatchableTrait;
    use EventGenerator;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'song:vote-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends an email to users that haven\'t voted for a song';

    /**
     * @var SongInterface
     */
    protected $song;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * Create a new command instance.
     *
     * @return \Ss\Commands\VoteReminder
     */
    public function __construct(UserInterface $user, SongInterface $song)
    {
        parent::__construct();

        $this->song = $song;
        $this->user = $user;
    }

    /**
     * When a command should run.
     *
     * @param Scheduler|Schedulable $scheduler
     * @return \Indatus\Dispatcher\Scheduling\Schedulable
     */
    public function schedule(Schedulable $scheduler)
    {
        // check/send daily from 9am-6pm, every 15 minutes
        return $scheduler->hours([9, 10, 11, 12, 13, 14, 15, 16, 17, 18])->minutes([0, 15, 30, 45]);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        // find all songs that haven't been reminded
        $songs = $this->song->remindable(Config::get('settings.vote_reminder_days'));

        if ($songs->count() > 0) {
            foreach ($songs as $song) {
                // @todo: this doesn't work...$this->execute(UpdateRemindedAtDate::class, ['song' => $song]);
                $song = Song::updateRemindedAt($song);
                $song->save();

                // get emailable users that haven't voted
                $users = $this->user->getNotifiesForSong($song->id);

                // send emails to emailable users
                if (count($users) > 0) {
                    $this->raise(new UsersVoteNotification($song, $users));
                    $this->dispatchEventsFor($this);

                    $this->info(count($users) . ' emails sent.');

                    // break if emails were sent
                    break;
                }
            }
        }

        $this->info('Total Remindable Songs: ' . $songs->count());
    }
}

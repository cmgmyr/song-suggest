<?php

namespace Ss\Domain\User;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Ss\Repositories\User\User;
use Ss\Repositories\User\UserInterface;

class RestoreUserCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    /**
     * @var UserInterface
     */
    protected $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the command.
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $user = User::restoreUser($command->user);

        $this->user->restore($user);

        $this->dispatchEventsFor($user);

        return $user;
    }
}

<?php

namespace Ss\Domain\User;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Ss\Repositories\User\User;
use Ss\Repositories\User\UserInterface;

class CreateUserCommandHandler implements CommandHandler
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
        $user = User::add($command->first_name, $command->last_name, $command->email, $command->password, $command->is_admin, $command->is_active, $command->notify);

        $this->user->save($user);

        $this->dispatchEventsFor($user);

        return $user;
    }
}

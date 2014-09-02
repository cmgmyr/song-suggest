<?php
namespace Ss\Domain\User;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Ss\Repositories\User\User;
use Ss\Repositories\User\UserInterface;

class DeleteUserCommandHandler implements CommandHandler
{

    use DispatchableTrait;

    /**
     * @var \Ss\Repositories\User\UserInterface
     */
    protected $user;

    function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        $user = User::deleteUser($command->user);

        $this->user->delete($user);

        $this->dispatchEventsFor($user);

        return $user;
    }
}
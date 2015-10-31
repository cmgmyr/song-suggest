<?php

namespace Ss\Domain\User;

class CreateUserCommand
{
    /**
     * @var
     */
    public $first_name;

    /**
     * @var
     */
    public $last_name;

    /**
     * @var
     */
    public $email;

    /**
     * @var
     */
    public $password;

    /**
     * @var
     */
    public $is_admin;

    /**
     * @var
     */
    public $is_active;

    /**
     * @var
     */
    public $notify;

    public function __construct($first_name, $last_name, $email, $password, $is_admin, $is_active, $notify)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->is_admin = $is_admin;
        $this->is_active = $is_active;
        $this->notify = $notify;
    }
}

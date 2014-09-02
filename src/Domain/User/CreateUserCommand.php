<?php
namespace Ss\Domain\User;

class CreateUserCommand
{

    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $is_admin;
    public $is_active;

    function __construct($first_name, $last_name, $email, $password, $is_admin, $is_active)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->is_admin = $is_admin;
        $this->is_active = $is_active;
    }
} 
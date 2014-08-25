<?php
namespace Ss\Forms;

use Ss\Services\Validation\FormValidator;

class UserForm extends FormValidator
{

    protected $rules = array(
        'first_name' => 'required',
        'last_name'  => 'required',
        'email'      => array('required', 'email'),
    );

    public function createUser()
    {
        $this->checkPassword();
        $this->enableUniqueEmail();

        return $this;
    }

    public function updateUser($id)
    {
        $this->enableUniqueEmailIgnoreId($id);

        return $this;
    }

    public function checkPassword()
    {
        $this->rules['password'] = array('required', 'same:password_confirm');
    }

    public function enableUniqueEmail()
    {
        $this->rules['email'] = array('required', 'email', 'unique:users');
    }

    public function enableUniqueEmailIgnoreId($id)
    {
        $this->rules['email'] = array('required', 'email', 'unique:users,email,' . $id);
    }
} 
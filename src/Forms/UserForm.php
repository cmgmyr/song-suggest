<?php
namespace Ss\Forms;

use Ss\Services\Validation\FormValidator;

class UserForm extends FormValidator
{
    protected $rules = [
        'first_name' => 'required',
        'last_name'  => 'required',
        'email'      => ['required', 'email'],
    ];

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
        $this->rules['password'] = ['required', 'same:password_confirm'];
    }

    public function enableUniqueEmail()
    {
        $this->rules['email'] = ['required', 'email', 'unique:users'];
    }

    public function enableUniqueEmailIgnoreId($id)
    {
        $this->rules['email'] = ['required', 'email', 'unique:users,email,' . $id];
    }
}

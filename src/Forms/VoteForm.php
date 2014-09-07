<?php
namespace Ss\Forms;

use Ss\Services\Validation\FormValidator;

class VoteForm extends FormValidator
{

    protected $rules = [
        'vote' => 'required',
    ];
} 
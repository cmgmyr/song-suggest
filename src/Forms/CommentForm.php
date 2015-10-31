<?php

namespace Ss\Forms;

use Ss\Services\Validation\FormValidator;

class CommentForm extends FormValidator
{
    protected $rules = [
        'comment' => 'required',
    ];
}

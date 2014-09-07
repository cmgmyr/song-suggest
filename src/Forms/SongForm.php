<?php
namespace Ss\Forms;

use Ss\Services\Validation\FormValidator;

class SongForm extends FormValidator
{

    protected $rules = [
        'artist' => 'required',
        'title'  => 'required',
    ];
} 
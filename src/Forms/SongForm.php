<?php
namespace Ss\Forms;

use Ss\Services\Validation\FormValidator;

class SongForm extends FormValidator
{

    protected $rules = array(
        'artist' => 'required',
        'title'  => 'required',
    );
} 
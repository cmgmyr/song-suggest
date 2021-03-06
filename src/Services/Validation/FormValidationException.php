<?php

namespace Ss\Services\Validation;

use Illuminate\Support\MessageBag;

class FormValidationException extends \Exception
{
    /**
     * @var MessageBag
     */
    protected $errors;

    public function __construct($message, MessageBag $errors)
    {
        $this->errors = $errors;

        parent::__construct($message);
    }

    /**
     * @return object
     */
    public function getErrors()
    {
        return $this->errors;
    }
}

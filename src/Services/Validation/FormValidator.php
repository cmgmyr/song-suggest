<?php
namespace Ss\Services\Validation;

use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Factory as Validator;

abstract class FormValidator
{

    /**
     * @var \Illuminate\Validation\Factory
     */

    protected $validator;

    /**
     * @var ovject
     */
    protected $validation;

    /**
     * @var array
     */
    protected $rules;

    function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param array $formData
     * @return bool
     * @throws FormValidationException
     */
    public function validate($formData = null)
    {
        $formData = $formData ? : Input::all();

        $this->validation = $this->validator->make($formData, $this->getValidationRules());

        if ($this->validation->fails()) {
            throw new FormValidationException('Validation Failed', $this->getValidationErrors());
        }

        return true;
    }

    /**
     * @return array
     */
    protected function getValidationRules()
    {
        return $this->rules;
    }

    /**
     * @return mixed
     */
    protected function getValidationErrors()
    {
        return $this->validation->errors();
    }
}
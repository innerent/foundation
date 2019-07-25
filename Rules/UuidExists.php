<?php

namespace Innerent\Foundation\Rules;

use Illuminate\Contracts\Validation\Rule;

class UuidExists implements Rule
{
    protected $model;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->model::whereUuid($value)->first() ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Uuid does not exists.';
    }
}

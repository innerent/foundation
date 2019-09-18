<?php

namespace Innerent\Foundation\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cpf implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $cpf = preg_replace('/\D/', '', $value);

        if (strlen($cpf) != 11 || preg_match("/^{$cpf[0]}{11}$/", $cpf)) {
            return false;
        }

        for ($s = 10, $n = 0, $i = 0; $s >= 2; $n += $cpf[$i++] * $s--);

        if ($cpf[9] != (($n %= 11) < 2 ? 0 : 11 - $n)) {
            return false;
        }

        for ($s = 11, $n = 0, $i = 0; $s >= 2; $n += $cpf[$i++] * $s--);

        if ($cpf[10] != (($n %= 11) < 2 ? 0 : 11 - $n)) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid CPF number.';
    }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MixedLetterNumber implements Rule
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
        // Memeriksa apakah password mengandung kombinasi huruf dan angka
        return preg_match('/^(?=.*[a-zA-Z])(?=.*\d).+$/', $value);
    }

    public function message()
    {
        return 'Password harus mengandung kombinasi huruf dan angka.';
    }
}

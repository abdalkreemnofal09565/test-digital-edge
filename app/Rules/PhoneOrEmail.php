<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class PhoneOrEmail implements Rule
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
       
        $is_valid_email = Validator::make(['email' => $value], ['email' => ['email']])->passes();
        
        $is_valid_phone = Validator::make(['phone' => $value], ['phone' => ['numeric']])->passes();
        return $is_valid_email || $is_valid_phone;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'the :attribute must be either a valid phone or a valid email.';
    }
}

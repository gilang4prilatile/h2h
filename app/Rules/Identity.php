<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Identity implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    private $tipeIdentitas = "";
    private $lengthRule = 12;
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
        var_dump($value);
        $this->tipeIdentitas = request()->input("tipe_identitas");
        if ($this->tipeIdentitas == 'ktp') {
            $this->lengthRule = 16;
        }

        if ($this->tipeIdentitas == 'npwp-15-digit') {
            $this->lengthRule = 15;
        }

        return count($value) == $this->lengthRule;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The ". $this->tipeIdentitas . " number length must be " . $this->lengthRule . " digits";
    }
}

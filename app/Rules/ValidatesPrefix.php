<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidatesPrefix implements Rule
{
    /**
     * @var array
     */
    private $prefixes;

    /**
     * Create a new rule instance.
     *
     * @param array $prefixes
     */
    public function __construct(array $prefixes)
    {
        //
        $this->prefixes = $prefixes;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): ?bool
    {
        return in_array($value, $this->prefixes);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Uses an unregistered prefix.';
    }
}

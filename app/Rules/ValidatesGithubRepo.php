<?php

namespace App\Rules;

use App\Services\Publish\GitHubService;
use Illuminate\Contracts\Validation\Rule;

class ValidatesGithubRepo implements Rule
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
        if ($value) {
            return GitHubService::GetPublicRepo($value) !== false;
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
        return "You must supply a valid GitHub repository path in the form of: 'User/Repository";
    }
}

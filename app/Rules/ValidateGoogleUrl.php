<?php

namespace App\Rules;

use App\Services\Import\GoogleSpreadsheet;
use Arcanedev\NoCaptcha\Exceptions\InvalidUrlException;
use Illuminate\Validation\Validator;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

class ValidateGoogleUrl
{
    /**
     * @param string    $attribute
     * @param string    $sheetUrl
     * @param array     $parameters
     * @param Validator $validator
     *
     * @return bool
     * @throws \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function validateSheet($attribute, $sheetUrl, $parameters, $validator)
    {
        return strpos($sheetUrl, "https://docs.google.com/spreadsheets") !== false;
    }
}

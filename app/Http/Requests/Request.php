<?php

namespace App\Http\Requests;

use App\Exceptions\GeneralException;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class Request.
 */
abstract class Request extends FormRequest
{
    /**
     * @var string
     */
    protected $error = '';

    /**
     * @throws GeneralException
     */
    protected function failedAuthorization()
    {
        if (empty($this->error)) {
            $this->error = trans('backpack::crud.unauthorized_access');
        }

        return redirect()->back()->withInput()->withErrors($this->error);
    }
}

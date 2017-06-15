<?php

namespace App\Http\Requests;

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
     * @return $this
     */
    public function forbiddenResponse()
    {
        if (empty($error)) {
            $this->error = trans('backpack::crud.unauthorized_access');
        }

    return redirect()->back()->withErrors($this->error);
  }
}

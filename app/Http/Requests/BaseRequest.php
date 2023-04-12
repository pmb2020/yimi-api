<?php

namespace App\Http\Requests;

use App\Common\ErrorCode;
use App\Exceptions\ApiException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    /**
     * 表单验证失败
     * @param Validator $validator
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ApiException([ErrorCode::FORM_VERIFY_FAIL[0],$validator->errors()->first()]);
    }

}

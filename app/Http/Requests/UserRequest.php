<?php

namespace App\Http\Requests;

class UserRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function rules(): array
    {
        $rules = [
            'phone' => 'bail|required|regex:/^1[345789][0-9]{9}$/'.'|unique:users',
            'password' => 'bail|required|min:6|max:32'
        ];
        if ($this->route()->getActionMethod() === 'login'){
            $rules['phone'] = 'bail|required|regex:/^1[345789][0-9]{9}$/';
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'phone.required' => '手机号不能为空',
            'phone.regex' => '请检查手机号格式',
            'phone.unique' => '该手机号已存在',
            'password.required' => '密码不能为空',
            'password.min' => '密码太短了吧',
            'password.max' => '密码太长了吧',
        ];
    }
}

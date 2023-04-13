<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Log;

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
            'password' => 'bail|required|min:6|max:32',
            'nickname' => 'bail|filled|min:6|max:32'
        ];
//        if ($this->route()->getActionMethod() === 'login'){
//            $rules['phone'] = 'bail|required|regex:/^1[345789][0-9]{9}$/';
//        }
        if ($this->isMethod('PUT')){
            $rules = [
                'phone' => 'bail|filled|regex:/^1[345789][0-9]{9}$/',
                'password' => 'bail|filled|min:6|max:32',
                'nickname' => 'bail|filled|min:3|max:32'
            ];
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

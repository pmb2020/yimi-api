<?php

namespace App\Http\Requests;

class AdminRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'username' => 'bail|required|min:3|unique:admins',
            'password' => 'bail|required|min:6|max:32',
            'nickname' => 'bail|filled|min:1|max:32',
            'tel' => 'bail|filled|regex:/^1[345789][0-9]{9}$/'
        ];
        if ($this->isMethod('PUT')){
            $rules = [
                'username' => 'bail|filled|min:3',
                'password' => 'bail|filled|min:6|max:32',
                'nickname' => 'bail|filled|min:1|max:32',
                'tel' => 'bail|filled|regex:/^1[345789][0-9]{9}$/'
            ];
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'username.required' => '用户名不能为空',
            'username.unique' => '该用户名已存在',
            'username.min' => '用户名太短了吧',
            'tel.regex' => '请检查手机号格式',
            'tel.unique' => '该手机号已存在',
            'password.required' => '密码不能为空',
            'password.min' => '密码太短了吧',
            'password.max' => '密码太长了吧',
        ];
    }
}

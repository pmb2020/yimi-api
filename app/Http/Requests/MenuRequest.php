<?php

namespace App\Http\Requests;

class MenuRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'bail|required|unique:menus',
            'title' => 'bail|required|min:1|max:30',
            'icon' => 'bail|filled',
            'path' => 'bail|required'
        ];
        if ($this->isMethod('PUT')){
            $rules = [
                'name' => 'bail|filled|unique:menus',
                'title' => 'bail|filled|min:1|max:30',
                'icon' => 'bail|filled',
                'path' => 'bail|required'
            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => '路由名称不能为空',
            'name.unique' => '该路由名称已经存在',
        ];
    }
}

<?php

namespace App\Http\Requests;

class BannerRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'image' => 'bail|required',
        ];

        if ($this->isMethod('PUT')){
            $rules = [
                'image' => 'bail|filled',
            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'image.required' => '图片是必须的哦',
            'image.filled' => '图片不能为空'
        ];
    }
}

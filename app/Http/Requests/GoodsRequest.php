<?php

namespace App\Http\Requests;

use App\Models\BaseModel;

class GoodsRequest extends BaseModel
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'bail|required|min:3|max:80',
            'stock' => 'bail|required|min:6|max:32',
            'nickname' => 'bail|filled|min:6|max:32'
        ];

        if ($this->isMethod('PUT')){
            $rules = [
                'title' => 'bail|required|min:3|max:80',
                'password' => 'bail|filled|min:6|max:32',
            ];
        }
        return $rules;
    }
}

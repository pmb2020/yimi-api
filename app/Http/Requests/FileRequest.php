<?php

namespace App\Http\Requests;

class FileRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'file' => 'required|image'
        ];
    }

    public function messages()
    {
        return [
            'file.required' => '文件是必传项',
            'file.image' => '文件格式不正确'
        ];
    }
}

<?php

namespace App\Http\Requests\permission;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>[
                'required',
                'regex:/^[a-zA-Z0-9\-]+$/',
                'unique:roles,name,'.$this->request->get('name')
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Chưa điền tên vai trò.',
            'name.unique' => 'Key đã bị trùng.',
            'name.regex' => 'Tên key không được chứa kí tự đặc biệt hoặc khoảng trắng ( trừ dấu "-" ).',
        ];
    }
}

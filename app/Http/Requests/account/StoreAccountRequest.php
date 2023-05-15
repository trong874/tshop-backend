<?php

namespace App\Http\Requests\account;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'username'=>'required|unique:users|min:3|max:50|regex:/\w*$/',
            'email'=>'required|unique:users|email',
            'password'=>'required|confirmed|min:6',
        ];
    }
    public function messages(): array
    {
        return [
            'username.required' => 'Chưa điền tên tài khoản.',
            'username.unique' => 'Tên tài khoản đã được sử dụng',
            'email.unique' => 'Mỗi email chỉ đăng kí được một tài khoản.',
            'username.min' => 'Tên tài khoản tối thiểu là 3 ký tự.',
            'username.max' => 'Tên tài khoản tối thiểu là 50 ký tự.',
            'username.regex' => 'Tên tài khoản không được chứa khoảng cách và ký tự đặc biệt.',
            'password.required' => 'Chưa điền mật khẩu.',
            'password.min' => 'Mật khẩu tối thiểu dài 6 kí tự.',
            'password.confirmed' => 'Xác nhận mật khẩu chưa khớp.',
        ];
    }
}

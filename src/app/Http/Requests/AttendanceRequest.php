<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'name' => ['required','string','max:191'],
            'email' => ['required','string','email','max:191','unique:email'],
            'password' => ['required','string','min:8','max:191'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'お名前を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'password.required' => 'パスワードを入力してください',
            'name.max' => '255字以下の文字を入力してください',
            'email.max' => '255字以下の文字を入力してください',
            'password.min' => '8字以上の文字を入力してください',
            'password.max' => '255字以下の文字を入力してください',
            'name.string' => '名前を文字列で入力してください',
            'email.string' => 'メールアドレスを文字列で入力してください',
            'password.string' => 'パスワードを文字列で入力してください',
            'email.email' => 'メールアドレスは「ユーザ名@ドメイン」形式で入力してください',
            'email.unique' => '同じメールアドレスが既に登録されています',
        ];
    }
}

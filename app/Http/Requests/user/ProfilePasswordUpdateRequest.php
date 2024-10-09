<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class ProfilePasswordUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Reset password gagal, field tidak boleh kosong',
            'new_password.required' => 'Reset password gagal, field tidak boleh kosong',
            'new_password.min' => 'Reset password gagal, password tidak boleh kurang dari 8 karakter',
            'new_password.confirmed' => 'Reset password gagal, password yang anda masukkan tidak sama'
        ];
    }
}

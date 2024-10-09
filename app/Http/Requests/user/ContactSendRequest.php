<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class ContactSendRequest extends FormRequest
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
            'name' => 'required|max:255|string',
            'email' => 'required|email',
            'message' => 'required|string',
            'g-recaptcha-response' => 'required|captcha',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama tidak boleh kosong!',
            'name.max' => 'Nama tidak boleh lebih dari 25 karakter',
            'nama.string' => 'Nama harus berupa string/teks',
            'email.required' => 'Email tidak boleh kosong!',
            'email.email' => 'Email tidak valid',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class JuraganStoreRequest extends FormRequest
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
            'address' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'max:255', 'string'],
            'copyright_text' => ['required', 'max:500'],
            'coordinate' => ['required', 'max:255', 'string'],
            'logo_website' => ['required', 'max:255', 'image'],
            'link_fb' => ['nullable', 'max:255', 'string'],
            'link_twitter' => ['nullable', 'max:255', 'string'],
            'link_instagram' => ['nullable', 'max:255', 'string'],
            'link_youtube' => ['nullable', 'max:255', 'string'],
            'long_description' => ['required', 'string'],
            'contact_description' => ['required', 'string'],
            'banner_website' => ['image', 'max:5100', 'required'],
        ];
    }
}

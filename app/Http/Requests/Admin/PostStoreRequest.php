<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'title' => ['required', 'max:255', 'string'],
            'slug' => ['required', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'content' => ['required', 'string'],
            'user_id' => ['required', 'exists:users,id'],
            'topic_mix_id' => ['required', 'exists:topic_mixes,id'],
        ];
    }
}

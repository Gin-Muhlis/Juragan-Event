<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class VisitorsUpdateRequest extends FormRequest
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
            'post_id' => ['required', 'max:255'],
            'ip_address' => [
                'required',
                Rule::unique('visitors', 'ip_address')->ignore($this->visitors),
                'max:255',
                'string',
            ],
        ];
    }
}

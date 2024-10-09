<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddressEventUpdateRequest extends FormRequest
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
            'longitude' => ['required', 'numeric'],
            'latitutde' => ['required', 'numeric'],
            'event_id' => ['required', 'exists:events,id'],
        ];
    }
}

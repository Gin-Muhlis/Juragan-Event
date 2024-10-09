<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TicketUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'price' => ['required', 'numeric'],
            'quota' => ['required', 'numeric'],
            'star_sale_at' => ['required', 'date'],
            'end_sale_at' => ['required', 'date'],
            'type' => ['required', 'in:berbayar,gratis,bayar sesukamu'],
            'event_id' => ['required', 'exists:events,id'],
            'discount' => ['required', 'numeric'],
            'fee_admin' => ['required', 'numeric'],
            'tax_coast' => ['required', 'numeric'],
        ];
    }
}

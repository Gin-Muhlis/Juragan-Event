<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TransactionDetailStoreRequest extends FormRequest
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
            'quantity' => ['required', 'numeric'],
            'unit_price' => ['required', 'numeric'],
            'total_price' => ['required', 'max:255'],
            'transaction_headers_id' => [
                'required',
                'exists:transaction_headers,id',
            ],
            'ticket_id' => ['required', 'exists:tickets,id'],
        ];
    }
}

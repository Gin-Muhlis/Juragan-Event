<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TransactionHeadersUpdateRequest extends FormRequest
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
            'transaction_date' => ['required', 'date'],
            'no_transaction' => [
                'required',
                Rule::unique('transaction_headers', 'no_transaction')->ignore(
                    $this->transactionHeaders
                ),
                'max:255',
            ],
            'total_transaction' => ['required', 'max:255'],
            'status' => [
                'required',
                'in:menunggu pembayaran,selesai,dibatalkan',
            ],
            'event_id' => ['required', 'exists:events,id'],
            'user_id' => ['required', 'exists:users,id'],
            'payment_id' => ['required', 'exists:payments,id'],
            'proof_of_payment' => ['max:3000', 'image']
        ];
    }
}

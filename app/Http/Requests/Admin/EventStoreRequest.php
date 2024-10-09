<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends FormRequest
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
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date'],
            'type' => ['required', 'in:Offline,Online'],
            'slug' => ['required', 'max:255', 'string'],
            'banner' => ['image', 'max:2048', 'required'],
            'description' => ['required', 'string'],
            'terms' => ['required', 'string'],
            'city_id' => ['exists:cities,id'],
            'organizer_id' => ['required', 'exists:organizers,id'],
            'format_mix_id' => ['required', 'exists:format_mixes,id'],
            'topic_mix_id' => ['required', 'exists:topic_mixes,id'],
        ];
    }
}

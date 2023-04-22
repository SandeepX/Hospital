<?php

namespace App\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventRequest extends FormRequest
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

    public function prepareForValidation()
    {
        $this->merge([
            'event_start_on' => date("Y-m-d H:i", strtotime($this->event_start_on)),
            'event_ends_on' => date("Y-m-d H:i", strtotime($this->event_ends_on)),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => ['required', 'string', 'min:2'],
            'sub_title' => ['required', 'string', 'min:2'],
            'venue' => ['nullable', 'string', 'min:2'],
            'event_start_on' =>  'nullable|date|date_format:Y-m-d H:i|after_or_equal:today',
            'event_ends_on' =>  'nullable|date|date_format:Y-m-d H:i|after:event_start_on',
            'is_active' => ['nullable', 'boolean', Rule::in([1, 0])],
            'description' => 'required|string|min:50'
        ];
        if ($this->isMethod('put')) {
            $rules['image'] = ['sometimes', 'file', 'mimes:jpeg,png,jpg,gif,svg|max:5048'];
        } else {
            $rules['image'] = ['required', 'file', 'mimes:jpeg,png,jpg,gif,svg|max:5048'];
        }
        return $rules;
    }

}













<?php

namespace App\Requests\internationalPatient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InternationalPatientRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string'],
            'is_active' => ['nullable', 'boolean', Rule::in([1, 0])],
            'short_intro' => 'nullable|string|max:200',
            'description' => 'nullable|string|min:10',
        ];
        if ($this->isMethod('put')) {
            $rules['image'] = ['sometimes', 'file', 'mimes:jpeg,png,jpg,svg'];
        } else {
            $rules['image'] = ['required', 'file', 'mimes:jpeg,png,jpg,svg'];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'image.mimes' => "Invalid file type.",
            'description.min' => "Description cannot be less than 10 character.",
            'short_intro.max' => "Short Introduction cannot be more than 200 character."
        ];
    }

}

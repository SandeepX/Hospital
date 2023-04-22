<?php

namespace App\Requests\hospitalService;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HospitalServiceRequest extends FormRequest
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
            'name' => ['required', 'string', Rule::unique('hospital_services', 'name')->ignore($this->hospital_service)],
            'start_date' => 'nullable|date',
            'is_active' => ['nullable', 'boolean', Rule::in([1, 0])],
            'short_description' => 'nullable|string|min:20',
            'description' => 'nullable|string|min:20',
        ];
        if ($this->isMethod('put')) {
            $rules['png_class'] = ['sometimes', 'file', 'mimes:jpeg,png,jpg,svg'];
            $rules['image'] = ['sometimes', 'file', 'mimes:jpeg,png,jpg,svg'];
        } else {
            $rules['png_class'] = ['required', 'file', 'mimes:jpeg,png,jpg,svg'];
            $rules['image'] = ['required', 'file', 'mimes:jpeg,png,jpg,svg'];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'image.mimes' => "Invalid file type.",
            'description.min' => "Description should be at least 50 character."
        ];
    }

}













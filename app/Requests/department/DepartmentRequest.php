<?php

namespace App\Requests\department;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentRequest extends FormRequest
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
            'dept_name' => ['required','string',Rule::unique('departments','dept_name')->ignore($this->department)],
            'dept_opened' => 'nullable|date|before:today',
            'is_active' => ['nullable', 'boolean', Rule::in([1, 0])],
            'description' => 'required|string|min:20'
        ];
        if ($this->isMethod('put')) {
            $rules['png_class'] = ['sometimes', 'file', 'mimes:jpeg,png,jpg,gif,svg|max:5048'];
            $rules['image'] = ['sometimes', 'file', 'mimes:jpeg,png,jpg,gif,svg|max:5048'];
        } else {
            $rules['png_class'] = ['required', 'file', 'mimes:jpeg,png,jpg,gif,svg|max:5048'];
            $rules['image'] = ['required', 'file', 'mimes:jpeg,png,jpg,gif,svg|max:5048'];
        }
        return $rules;
    }

}












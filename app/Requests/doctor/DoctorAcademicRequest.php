<?php

namespace App\Requests\doctor;

use Illuminate\Foundation\Http\FormRequest;

class DoctorAcademicRequest extends FormRequest
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
            'academic' => ['bail','nullable','array','min:1'],
            'academic.*.qualification' => ['bail','nullable','string'],
            'academic.*.university' => ['required_with:academic.*.qualification','nullable','string'],
            'academic.*.passed_year' => ['required_with:academic.*.qualification','nullable','date','before_or_equal:today']
        ];
    }

    public function messages()
    {
        return [
            'academic.*.university.required_with' => "University is required with qualification.",
            'academic.*.passed_year.required_with' => "Passed Year is required with qualification.",
        ];
    }
}

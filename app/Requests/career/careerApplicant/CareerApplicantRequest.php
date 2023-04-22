<?php

namespace App\Requests\career\careerApplicant;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class CareerApplicantRequest extends FormRequest
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
            'full_name' => ['required', 'string'],
            'career_master_id' => ['required', 'exists:career_master_details,id'],
            'email' => ['required','string', 'email'],
            'contact_no' => ['required', new PhoneNumber],
            'cv' => ['required', 'file','mimes:pdf,doc,docx'],
            'cover_letter' => ['required', 'file','mimes:pdf,doc,docx'],
            'expected_salary' => ['nullable', 'numeric','min:1'],
            'note' => ['nullable', 'string', 'max:1000']
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Please enter your name.',
            'career_master_id.required' => 'Please enter your valid contact number',
            'email.required' => 'Please enter your valid email address',
            'contact_no.required' => 'Please enter your valid contact number',
            'cv.required' => 'Please submit your CV',
            'cv.mimes' => 'Please submit your cover letter of type pdf, doc or docx',
            'cover_letter.required' => 'Please submit your cover letter',
            'cover_letter.mimes' => 'Please submit your cover letter of type pdf,doc or docx',
            'career_master_id.exists' => 'Career detail not found or is expired',
        ];
    }

}














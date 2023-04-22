<?php

namespace App\Requests\doctor;

use App\Models\Doctor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DoctorRequest extends FormRequest
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
            'dob' => date("Y-m-d", strtotime($this->dob))
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
            'full_name' => ['required', 'string', 'max:100'],
            'dob' => ['nullable','date','before:today'],
            'email' =>  ['nullable', 'email', Rule::unique('doctors','email')->ignore($this->doctor)],
            'address' => ['nullable', 'string'],
            'gender' => ['nullable', Rule::in(Doctor::GENDER)],
            'phone_no' => ['nullable', 'string'],
            'speciality' => ['nullable', 'string'],
            'bio' => ['nullable', 'string', 'min:50'],
            'experience_in_year' => ['nullable', 'numeric', 'min:1' ,'max:70'],
            'dept_id' => ['required', 'exists:departments,id'],
            'appointment_limit' =>  ['nullable','numeric','min:1'],
            'fb_link' => ['nullable', 'url'],
            'insta_link' => ['nullable', 'url'],
            'twitter_link' => ['nullable', 'url'],
            'is_active' => ['nullable', 'boolean', Rule::in([1, 0])]
        ];

        if ($this->isMethod('put')) {
            $rules['avatar'] = ['sometimes', 'file', 'mimes:jpeg,png,jpg,svg','max:5048'];
        } else {
            $rules['avatar'] = ['required', 'file', 'mimes:jpeg,png,jpg,svg','max:5048'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'experience_in_year.*.max' => "Experience cannot be more than 70 year.",
            'avatar.mimes' => "Invalid file type",
            'full_name.max' => "Name character limit exceeded",
            'bio.min' => "Biography cannot be less than 50 character",
        ];
    }





}

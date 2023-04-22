<?php

namespace App\Requests\doctor;

use Illuminate\Foundation\Http\FormRequest;

class DoctorExperienceRequest extends FormRequest
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
            'experience' => ['bail','nullable','array','min:1'],
            'experience.*.description' => ['bail','nullable','string','min:10'],
        ];
    }

    public function messages()
    {
        return [
            'experience.*.description.string' => "Experience Detail must be at least of 10 character.",
        ];
    }
}

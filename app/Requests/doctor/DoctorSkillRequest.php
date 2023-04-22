<?php

namespace App\Requests\doctor;

use Illuminate\Foundation\Http\FormRequest;

class DoctorSkillRequest extends FormRequest
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
            'skill' => ['bail','nullable','array','min:1'],
            'skill.*.skill_name' => ['nullable','string'],
            'skill.*.expertise_level' => ['required_with:skill.*.skill_name','nullable','numeric','min:1','max:100'],
        ];
    }

    public function messages()
    {
        return [
            'skill.*.expertise_level.required_with' => "Expertise level is required with skill name.",
        ];
    }
}

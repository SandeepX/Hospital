<?php

namespace App\Requests\career\careerDesignation;

use App\Models\MediaLink;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CareerDesignationUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', Rule::unique('career_designations', 'name')->ignore($this->career_designation)],
            'status' => ['nullable', 'boolean', Rule::in([1, 0])]
        ];

    }

}













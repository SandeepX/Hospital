<?php

namespace App\Requests\career\careerDesignation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CareerDesignationStoreRequest extends FormRequest
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
//        dd($this->all());
        return [
            'designation' => ['required', 'array', 'min:1'],
            'designation.*.name' => ['required', 'string', Rule::unique('career_designations', 'name')],
            'designation.*.status' => ['nullable', 'boolean', Rule::in([1, 0])],
        ];

    }

}














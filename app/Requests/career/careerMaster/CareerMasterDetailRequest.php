<?php

namespace App\Requests\career\careerMaster;

use App\Models\CareerMasterDetail;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CareerMasterDetailRequest extends FormRequest
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
            'job_opening_date' => date("Y-m-d", strtotime($this->job_opening_date)),
            'job_closing_date' => date("Y-m-d", strtotime($this->job_closing_date)),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
//        dd($this->all());
        $rules = [
            'title' => ['required', 'string', 'min:5'],
            'career_designation_id' => ['required', 'exists:career_designations,id'],
            'job_opening_date' =>  'required|date|date_format:Y-m-d|after_or_equal:today',
            'job_closing_date' =>  'required|date|date_format:Y-m-d|after:job_opening_date',
            'position_type' => ['required', Rule::in(CareerMasterDetail::POSITION_TYPE)],
            'openings' => ['required', 'numeric','min:1'],
            'address' => ['required', 'string'],
            'salary_offered' => ['nullable', 'string','min:1'],
            'status' => ['nullable', 'boolean', Rule::in([1, 0])],
            'description' => 'required|string|min:20'
        ];
        if ($this->isMethod('put')) {
            $rules['image'] = ['sometimes', 'file', 'mimes:jpeg,png,jpg,svg|max:9048'];
        } else {
            $rules['image'] = ['required', 'file', 'mimes:jpeg,png,jpg,svg|max:9048'];
        }
        return $rules;
    }

}














<?php

namespace App\Requests\Package;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PackageRequest extends FormRequest
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
//        dd($this->route());
        $rules = [
            'package_name' => ['required', 'string'],
            'package_title' => ['nullable', 'string'],
            'package_price' => ['nullable','numeric','min:0'],
            'description' => 'required|string|min:50',
            'is_active' => ['nullable', 'boolean', Rule::in([1, 0])],
        ];
        if ($this->isMethod('put')) {
            $rules['image'] = ['sometimes', 'file', 'mimes:jpeg,png,jpg,svg', 'max:9048'];
            $rules['package_icon'] = ['sometimes', 'file', 'mimes:png,jpg'];
        } else {
            $rules['image'] = ['required', 'file', 'mimes:jpeg,png,jpg,svg','max:9048'];
            $rules['package_icon'] = ['required', 'file', 'mimes:png,jpg'];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'image.mimes' => "Invalid file type.",
            'package_icon.mimes' => "Invalid file type.",
            'description.min' => "Description should be at least 50 character."
        ];
    }

}














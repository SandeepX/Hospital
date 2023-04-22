<?php

namespace App\Requests\testimonial;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TestimonialRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string', 'min:2'],
            'post' => ['required', 'string', 'min:2'],
            'is_published' => ['nullable', 'boolean', Rule::in([1, 0])],
            'description' => 'required|string|min:50',
            'rating' => ['required','numeric','min:1','max:5']
        ];
        if ($this->isMethod('put')) {
            $rules['image'] = ['sometimes', 'file', 'mimes:jpeg,png,jpg,gif,svg','max:5048'];
        } else {
            $rules['image'] = ['required', 'file', 'mimes:jpeg,png,jpg,gif,svg','max:5048'];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'image.mimes' => "Invalid file type.",
            'description.min' => "Description should be at least 50 character."
        ];
    }

}















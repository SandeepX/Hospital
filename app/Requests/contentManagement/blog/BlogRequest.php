<?php

namespace App\Requests\contentManagement\blog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
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
        $rules = [
            'title' => ['required', 'string', 'min:10'],
            'sub_title' => ['nullable', 'string', 'min:10','max:50'],
            'tags' => ['required', 'string', 'min:3'],
            'short_description' => 'required|string|min:30|max:500',
            'description' => 'required|string|min:200',
            'created_date' => 'required|date',
            'status' => ['nullable', 'boolean', Rule::in([1, 0])],
        ];

        if ($this->isMethod('put')) {
            $rules['image'] = ['sometimes', 'file', 'mimes:jpeg,png,jpg|max:9048'];
        } else {
            $rules['image'] = ['required', 'file', 'mimes:jpeg,png,jpg|max:9048'];
        }

        return $rules;
    }

}















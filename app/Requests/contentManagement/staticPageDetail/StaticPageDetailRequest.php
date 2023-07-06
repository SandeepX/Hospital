<?php

namespace App\Requests\contentManagement\staticPageDetail;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StaticPageDetailRequest extends FormRequest
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
            'title' => ['nullable', 'string', 'min:2'],
            'sub_title' => ['nullable', 'string', 'min:2'],
            'is_active' => ['nullable', 'boolean', Rule::in([1, 0])],
            'description' => 'required|string',
            'page_id' => 'required|exists:pages,id',
            'image' => ['sometimes', 'file', 'mimes:jpeg,png,jpg,gif,svg|max:5048']
        ];

    }

}














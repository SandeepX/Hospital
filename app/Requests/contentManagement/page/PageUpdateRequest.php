<?php

namespace App\Requests\contentManagement\page;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageUpdateRequest extends FormRequest
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
            'title' => ['nullable', 'string','min:5'],
            'sub_title' => 'nullable|string',
            'description_one' => 'nullable|string',
            'description_two' => 'nullable|string',
        ];
        return $rules;
    }

}













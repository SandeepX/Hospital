<?php

namespace App\Requests\download;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DownloadRequest extends FormRequest
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
            'title' => ['nullable', 'string', 'min:2'],
            'is_active' => ['nullable', 'boolean', Rule::in([1, 0])],
            'images' => ['required','array','min:1'],
            'images.*.' => ['required','file','mimes:pdf'],
        ];
        return $rules;
    }
}

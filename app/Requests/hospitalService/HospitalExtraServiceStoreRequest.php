<?php

namespace App\Requests\hospitalService;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HospitalExtraServiceStoreRequest extends FormRequest
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
            'extraService' =>['required','array','min:1'],
            'extraService.*.name' => ['required', 'string'],
//            'extraService.*.is_active' =>['some', 'boolean', Rule::in([1, 0])],
        ];

    }
}

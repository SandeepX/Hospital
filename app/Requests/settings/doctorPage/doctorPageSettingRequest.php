<?php

namespace App\Requests\settings\doctorPage;

use Illuminate\Foundation\Http\FormRequest;

class doctorPageSettingRequest extends FormRequest
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
            'intro' => 'nullable|string',
            'time' => 'nullable|string',
            'fix_appt' => 'nullable|string',
            'qualification' => 'nullable|string',
            'skill' => 'nullable|string',
            'experience' => 'nullable|string',
       ];
    }
}

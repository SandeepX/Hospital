<?php

namespace App\Requests\doctor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DoctorScheduleRequest extends FormRequest
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
            'doctor_id' => ['bail','required','exists:doctors,id'],
            'available_week_day' => ['bail','required','integer','min:0','max:6',
                Rule::unique('doctor_schedules','available_week_day')->where(function ($query) {
                        return $query->where('doctor_id', $this->doctor_id);
                    })->ignore($this->doctor_schedule)
                ],
            'scheduleTime.*.time_from' => ['bail','required','date_format:H:i'],
            'scheduleTime.*.time_to' => ['required_with:academic.*.time_from','nullable','date_format:H:i'],
            'scheduleTime.*.is_active' => ['nullable',Rule::in(1,0)],
        ];

    }
    public function messages()
    {
        return [
            'scheduleTime.*.time_to.required_with' => "Doctor time to is required with time from.",
        ];
    }

}

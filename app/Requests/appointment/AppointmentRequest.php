<?php

namespace App\Requests\appointment;

use App\Models\Appointment;
use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AppointmentRequest extends FormRequest
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
                'patients_name' => [ 'required', 'string'],
                'contact_no' => ['required',new PhoneNumber],
                'email' => ['required','email'],
                'gender' => [ 'required', Rule::in(Appointment::GENDER)],
                'age' => [ 'required', 'numeric','min:1','max:100'],
                'dept_id' => [ 'required', 'exists:departments,id'],
                'doctor_id' => [
                    'required',
                    Rule::exists('doctors', 'id')->where(function ($query) {
                        $query->where('dept_id', $this->dept_id);
                    })
                ],
                'appointment_time_id' => [ 'required', 'exists:doctor_schedule_time_details,id'],
                'appointment_date' => [ 'required','date', 'date_format:Y-m-d','after_or_equal:today'],
                'note' => ['nullable', 'string'],
                'reason' => ['nullable', 'string']
            ];
            if ($this->isMethod('put')) {
                $rules['status'] = ['required',  Rule::in(Appointment::STATUS)];
            } else {
                $rules['status'] = ['nullable',  Rule::in(Appointment::STATUS)];
            }
            return $rules;
    }

    public function messages()
    {
        return [
            'patients_name.required' => 'Please enter your name.',
            'contact_no.required' => 'Please enter your valid contact number',
            'email.required' => 'Please enter your valid email address',
//            'note.required' => 'Note is required',
            'age.required' => 'Please enter patient age',
//            'reason.required' => 'Please enter appointment reason',
            'gender.required' => 'Please select your gender',
            'dept_id.required' => 'Please select department',
            'doctor_id.required' => 'Please select doctor for appointment',
            'appointment_date.required' => 'Please select doctor appointment Date',
            'appointment_time_id.required' => 'Please select doctor appointment time',
            'dept_id.exists' => 'Department Not Found',
            'doctor_id.exists' => 'Doctor Not Found',
        ];
    }
}



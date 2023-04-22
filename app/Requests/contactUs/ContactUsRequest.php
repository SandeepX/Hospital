<?php

namespace App\Requests\contactUs;


use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'phone_no' => ['required'],
            'location' => ['required', 'string'],
            'message' => ['required', 'string']
        ];
    }



    public function messages()
    {
        return [
            'name.required' => 'Title is required for the post.',
            'email.required' => 'Valid email is required',
            'phone_no.required' => 'Phone Number is required',
            'location.required' => 'Location is required',
            'message.required' => 'Meassge is required',
        ];
    }



}

















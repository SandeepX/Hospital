<?php

namespace App\Requests\hospital;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HospitalProfileRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => ['required', 'email', Rule::unique('hospital_profiles','email')->ignore($this->hospital_profile)],
            'address' => 'required|string',
            'phone_one' => 'required|string',
            'phone_two' => 'nullable|numeric',
            'marquee_content' => 'required|string|min:1',
            'description' => 'required|string|min:10',
            'facebook_link' => 'nullable|url',
            'insta_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'website_url' => 'nullable|url',
            'location_lat' => 'nullable|numeric',
            'location_long' => 'nullable|numeric',
        ];
        if ($this->isMethod('put')) {
            $rules['logo'] = ['sometimes', 'file', 'mimes:jpeg,png,jpg,gif,svg','max:5048'];
        } else {
            $rules['logo'] = ['required', 'file', 'mimes:jpeg,png,jpg,gif,svg', 'max:5048'];
        }
        return $rules;

    }

    public function messages()
    {
        return [
            'image.mimes' => "Invalid file type.",
            'description.min' => "Description should be at least 10 character.",
        ];
    }

}











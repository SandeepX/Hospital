<?php

namespace App\Requests\Users;




use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => 'required|string',
            'email' =>['required','string','email',Rule::unique('users','email')->ignore($this->user)],
            'username' =>['required','string',Rule::unique('users','username')->ignore($this->user)],
            'password' => 'sometimes|string|min:4',
            'address' => 'required',
            'dob' => 'required|date|before:today',
            'phone' => 'required|numeric',
            'gender' => ['required', 'string', Rule::in(User::GENDER)],
            'role' => ['required', 'string', Rule::in(User::ROLE)],
            'designation' => ['required', 'string'],
            'description' => ['required', 'string'],
            'is_active' => ['nullable', 'boolean', Rule::in([1, 0])],
            'avatar' => ['sometimes', 'file', 'mimes:jpeg,png,jpg,gif,svg', 'max:9048'],
        ];

    }

    public function messages()
    {
        return [
            'avatar.mimes' => "Invalid file type."
        ];
    }

}
















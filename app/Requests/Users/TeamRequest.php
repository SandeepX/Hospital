<?php
namespace App\Requests\Users;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeamRequest extends FormRequest
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
            'designation' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'image' => ['sometimes', 'file', 'mimes:jpeg,png,jpg,gif,svg', 'max:9048'],
            'is_active' => ['nullable', 'boolean', Rule::in([1, 0])],
        ];

    }

    public function messages()
    {
        return [
           'image.mimes' => "Invalid file type."
        ];
    }
}

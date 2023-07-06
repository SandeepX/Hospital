<?php

namespace App\Requests\contentManagement\banner;

use App\Models\Banner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BannerRequest extends FormRequest
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
            'banner_type' => ['required', 'string', Rule::in(Banner::BANNER_TYPE)],
            'title' => ['nullable','required_if:banner_type,Normal_Banner','string','max:255'],
            'sub_title' => ['nullable', 'string','max:255'],
        ];
        if ($this->isMethod('put')) {
            $rules['image'] = ['sometimes', 'file', 'mimes:jpeg,png,jpg|max:5048'];
        } else {
            $rules['image'] = ['required', 'file', 'mimes:jpeg,png,jpg|max:5048'];
        }
        return $rules;

    }

}












<?php

namespace App\Requests\contentManagement\mediaLink;

use App\Models\MediaLink;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MediaLinkRequest extends FormRequest
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
//        dd($this->all());
        return [
            'url' => ['required','url',Rule::unique('media_links','url')->ignore($this->media_link)],
            'link_type' => ['required',Rule::in(MediaLink::LINK_TYPE)],
            'is_active' => ['nullable', 'boolean', Rule::in([1, 0])]
        ];

    }

}












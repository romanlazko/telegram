<?php

namespace Romanlazko\Telegram\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'                  => 'nullable|required|string',
            'images.*'              => 'nullable|sometimes|image|max:2048',
            'title'                 => 'nullable|sometimes|string',
            'description'           => 'nullable|required|string',
            'command'               => 'nullable|sometimes|string',
            'web_page_preview'      => 'nullable|sometimes|boolean',
            'is_active'             => 'nullable|sometimes|boolean',
        ];
    }
}

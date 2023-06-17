<?php

namespace Romanlazko\Telegram\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BotStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'url'   => 'required|url',
            'token' => 'required|regex:/[0-9]{1,}:\w*/',
        ];
    }
}

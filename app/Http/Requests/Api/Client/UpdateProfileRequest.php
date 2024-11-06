<?php

namespace App\Http\Requests\Api\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string',
            'email' => ['emai', Rule::unique('clients', 'email')->ignore($this->user()->id)],
            'phone' => ['emai', Rule::unique('clients', 'phone')->ignore($this->user()->id)],
            'district_id' => ['exists:districts,id'],
            'image' => 'image|mimes:png,jpg,jpeg,gif'
        ];
    }
}

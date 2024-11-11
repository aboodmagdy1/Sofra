<?php

namespace App\Http\Requests\Api\Restaurant;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRestaurantRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:restaurants,name',
            'email' => 'required|email|unique:restaurants,email',
            'phone' => 'required|string|unique:restaurants,phone',
            'contact_num' => 'required|string',
            'watts_num' => 'required|string',
            'password' => 'required|confirmed',
            'district_id' => ['required', 'exists:districts,id'],
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['required', 'exists:categories,id'],
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg,gif'],
            'min_order_price' => 'required|numeric',
            'delivery_price' => 'required|numeric',
            'status' => 'required|in:1,0',
        ];
    }
}

<?php

namespace App\Http\Requests\Api\Restaurant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRestaurantProfileRequest extends FormRequest
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
            'name' => Rule::unique('restaurants', 'name')->ignore($this->user()->id),
            'email' => Rule::unique('restaurants', 'email')->ignore($this->user()->id),
            'phone' => Rule::unique('restaurants', 'phone')->ignore($this->user()->id),
            'contact_num' => 'string',
            'watts_num' => 'string',
            'password' => 'confirmed',
            'district_id' =>  'exists:districts,id',
            'category_id' =>  'exists:categories,id',
            'image' => 'image|mimes:png,jpg,jpeg',
            'min_order_price' => 'numeric',
            'delivery_price' => 'numeric',
            'status' => 'in:1,0',

        ];
    }
}

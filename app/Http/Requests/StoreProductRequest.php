<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ["required", "string"],
            "quantity" => ["required", "integer"],
            "price" => ["required", "numeric"],
            "expiration_date" => ["date"],
            "location" => ["required", "string"],
            "category_id" => ["required", "integer", "exists:categories,id"]
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "client_id" => ["integer", "exists:clients,id"],
            "product_id" => ["integer", "exists:products,id"],
            "quantity" => ["integer"],
            "status" => ["string"],
        ];
    }
}

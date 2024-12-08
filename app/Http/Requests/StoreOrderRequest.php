<?php

namespace App\Http\Requests;

use App\Rules\StockAvailable;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "client_id" => ["required", "integer", "exists:clients,id"],
            "product_id" => ["required", "integer", "exists:products,id"],
            "quantity" => ["required", "integer", new StockAvailable($this->product_id)],
            "status" => ["required", "string"],
        ];
    }
}

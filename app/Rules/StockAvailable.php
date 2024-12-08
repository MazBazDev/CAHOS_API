<?php

namespace App\Rules;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StockAvailable implements ValidationRule
{
    protected int $productId;

    /**
     * Create a new rule instance.
     *
     * @param int $productId
     */
    public function __construct($productId)
    {
        $this->productId = $productId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $product = Product::find($this->productId);

        if (!$product) {
            $fail("Product not found.");
        };

        if ($product->quantity < $value) {
            $fail("Stock not available.");
        }
    }
}

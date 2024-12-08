<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'price',
        'expiration_date',
        'location',
        'category_id'
    ];

    protected $with = ['category'];

    protected $casts = [
        'expiration_date' => 'datetime:c',
        'created_at' => 'datetime:c',
        'updated_at' => 'datetime:c'
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

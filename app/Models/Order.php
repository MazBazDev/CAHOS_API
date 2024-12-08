<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory */
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'client_id',
        'product_id',
        'quantity',
        'total',
        'order_date',
        'status'
    ];

    protected $casts = [
        'total' => 'float',
        'order_date' => 'datetime:c'
    ];

    public function client(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

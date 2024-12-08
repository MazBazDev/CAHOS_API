<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory */
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'siret'
    ];

    protected $casts = [
        'created_at' => 'datetime:c',
        'updated_at' => 'datetime:c'
    ];

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class);
    }
}

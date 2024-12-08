<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    protected $fillable = [
        'action',
        'message',
        'user_id',
    ];

    protected $with = ['user'];

    protected $casts = [
        'created_at' => 'datetime:c'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

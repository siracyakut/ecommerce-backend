<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChargeHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'charge_histories';

    public $timestamps = false;

    protected $fillable = [
        'user',
        'amount',
        'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user');
    }
}

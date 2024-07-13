<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChargeHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'charge_histories';

    protected $fillable = [
        'user',
        'amount',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
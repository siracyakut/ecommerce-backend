<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tickets';

    public $timestamps = false;

    protected $fillable = [
        'user',
        'title',
        'message',
        'status',
        'category',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

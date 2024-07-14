<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketMessage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ticket_messages';

    public $timestamps = false;

    protected $fillable = [
        'ticket',
        'user',
        'message',
        'date',
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class, 'ticket');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user');
    }
}

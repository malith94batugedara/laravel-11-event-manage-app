<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;
    
    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'event_id',
        'num_of_tickets'
    ];
    
    public function user(): BelongsTo
    {
       return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}

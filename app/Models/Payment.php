<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected $fillable = [
        'booking_id',
        'reference',
        'email',
        'status',
        'provider',
        'date'
    ];
    protected $casts = [
        'date' => 'datetime',
    ];
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}

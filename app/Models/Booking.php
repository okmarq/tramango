<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'travel_option_id',
        'number_of_guests',
        'status_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function travelOption(): BelongsTo
    {
        return $this->belongsTo(TravelOption::class);
    }
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}

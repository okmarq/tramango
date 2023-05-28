<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;
    public const IS_APPROVED = 1;
    public const IS_DENIED = 2;
    public const IS_PENDING = 3;
    public const IS_AVAILABLE = 4;
    public const IS_UNAVAILABLE = 5;

    protected $fillable = ['name'];
    protected $guarded = ['id'];
    public $timestamps = false;
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}

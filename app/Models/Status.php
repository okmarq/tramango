<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $guarded = ['id'];
    public $timestamps = false;
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}

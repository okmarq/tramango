<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];
    public function travelOptions(): HasMany
    {
        return $this->hasMany(TravelOption::class);
    }
}

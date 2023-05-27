<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tour extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];
    public function travelOptions(): MorphMany
    {
        return $this->morphMany(TravelOption::class, 'travellable');
    }
}

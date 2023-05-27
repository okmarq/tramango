<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelOption extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $fillable = [
        'travellable_id',
        'travellable_type',
        'price',
        'start_date',
        'end_date',
        'location_id'
    ];
    public function travellable(): MorphTo
    {
        return $this->morphTo();
    }
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}

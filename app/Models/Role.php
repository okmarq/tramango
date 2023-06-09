<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;
    public const IS_ADMIN = 1;
    public const IS_USER = 2;
    protected $fillable = ['name'];
    protected $hidden = ['pivot'];
    protected $guarded = ['id'];
    public $timestamps = false;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}

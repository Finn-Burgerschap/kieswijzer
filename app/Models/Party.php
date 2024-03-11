<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Party extends Model
{
    protected $fillable = [
        'name'
    ];

    public function opinions(): HasMany
    {
        return $this->hasMany(Opinion::class);
    }
}

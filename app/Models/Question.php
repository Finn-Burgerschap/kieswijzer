<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $fillable = [
        'order',
        'title',
        'description'
    ];

    public function opinions(): HasMany
    {
        return $this->hasMany(Opinion::class);
    }
}

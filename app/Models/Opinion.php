<?php

namespace App\Models;

use App\Enums\OpinionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Opinion extends Model
{
    protected $fillable = [
        'question_id',
        'party_id',
        'opinion',
        'description'
    ];

    protected $casts = [
        'opinion' => OpinionType::class
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function party(): BelongsTo
    {
        return $this->belongsTo(Party::class);
    }
}

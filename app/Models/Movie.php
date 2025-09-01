<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'overview',
        'poster_path',
        'release_date',
        'vote_average',
        'catalogue_id'
    ];

    public function catalogue(): BelongsTo
    {
        return $this->belongsTo(Catalogue::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Catalogue extends Model
{
    use HasFactory;
    public $fillable = ['name', 'description'];

    public function movies(): HasMany
    {
        return $this->hasMany(Movie::class);
    }
}

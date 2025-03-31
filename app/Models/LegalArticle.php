<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LegalArticle extends Model
{
    protected $fillable = ['article_number', 'description'];

    public function seizedVehicles(): HasMany
    {
        return $this->hasMany(SeizedVehicle::class);
    }
}

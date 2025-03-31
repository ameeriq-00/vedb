<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Accessory extends Model
{
    protected $fillable = ['name'];

    public function seizedVehicles(): BelongsToMany
    {
        return $this->belongsToMany(SeizedVehicle::class);
    }
}

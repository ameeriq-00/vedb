<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Directorate extends Model
{
    protected $fillable = ['name'];

    public function seizedVehicles(): HasMany
    {
        return $this->hasMany(SeizedVehicle::class);
    }

    public function governmentVehicles(): HasMany
    {
        return $this->hasMany(GovernmentVehicle::class);
    }
}


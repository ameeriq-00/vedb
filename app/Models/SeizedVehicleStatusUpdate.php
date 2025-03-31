<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeizedVehicleStatusUpdate extends Model
{
    protected $fillable = ['seized_vehicle_id', 'status', 'decision_number', 'decision_date', 'attachment_path', 'user_id'];

    protected $casts = [
        'decision_date' => 'date',
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(SeizedVehicle::class, 'seized_vehicle_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

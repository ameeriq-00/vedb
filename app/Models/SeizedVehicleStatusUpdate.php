<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SeizedVehicleStatusUpdate extends Model
{
    use LogsActivity;

    protected $fillable = [
        'seized_vehicle_id',
        'status',
        'decision_number',
        'decision_date',
        'attachment_path',
        'user_id'
    ];

    protected $casts = [
        'decision_date' => 'date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly([
                'status',
                'decision_number',
                'decision_date'
            ])
            ->useLogName('seized_vehicle_status');
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(SeizedVehicle::class, 'seized_vehicle_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Transfer extends Model
{
    use LogsActivity;

    protected $fillable = [
        'seized_vehicle_id',
        'recipient_name',
        'recipient_identity_number',
        'to_directorate_id',
        'user_id',
        'transfer_date',
    ];

    protected $casts = [
        'transfer_date' => 'date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly(['recipient_name', 'recipient_identity_number', 'to_directorate_id'])
            ->useLogName('transfer');
    }

    public function seizedVehicle(): BelongsTo
    {
        return $this->belongsTo(SeizedVehicle::class);
    }

    public function toDirectorate(): BelongsTo
    {
        return $this->belongsTo(Directorate::class, 'to_directorate_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

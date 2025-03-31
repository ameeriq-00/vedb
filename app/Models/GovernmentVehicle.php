<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class GovernmentVehicle extends Model
{
    use LogsActivity;

    protected $fillable = [
        'directorate_id',
        'vehicle_name',
        'vehicle_number',
        'model',
        'chassis_number',
        'governorate',
        'color',
        'condition',
        'accessories',
        'defects',
        'source_document_number',
        'source_document_date',
        'user_id',
    ];

    protected $casts = [
        'source_document_date' => 'date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly([
                'vehicle_name',
                'vehicle_number',
                'model',
                'chassis_number',
                'condition',
                'directorate_id'
            ])
            ->useLogName('government_vehicle');
    }

    public function directorate(): BelongsTo
    {
        return $this->belongsTo(Directorate::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SeizedVehicle extends Model
{
    use LogsActivity;

    protected $fillable = [
        'directorate_id',
        'legal_article_id',
        'accused_name',
        'vehicle_name',
        'vehicle_number',
        'governorate',
        'color',
        'model',
        'chassis_number',
        'condition',
        'status',
        'is_released',
        'is_external',
    ];

    protected $casts = [
        'is_released' => 'boolean',
        'is_external' => 'boolean',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly([
                'status',
                'condition',
                'directorate_id',
                'legal_article_id',
                'vehicle_number',
                'model',
                'chassis_number',
            ])
            ->useLogName('seized_vehicle');
    }

    public function directorate(): BelongsTo
    {
        return $this->belongsTo(Directorate::class);
    }

    public function legalArticle(): BelongsTo
    {
        return $this->belongsTo(LegalArticle::class);
    }

    public function statusUpdates(): HasMany
    {
        return $this->hasMany(SeizedVehicleStatusUpdate::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }

    public function transfers(): HasMany
    {
        return $this->hasMany(Transfer::class);
    }

    public function accessories(): BelongsToMany
    {
        return $this->belongsToMany(Accessory::class);
    }

    public function defects(): BelongsToMany
    {
        return $this->belongsToMany(Defect::class);
    }
}

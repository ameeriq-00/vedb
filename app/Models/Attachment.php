<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Attachment extends Model
{
    use LogsActivity;

    protected $fillable = ['seized_vehicle_id', 'file_path', 'type', 'user_id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnlyDirty()
            ->logOnly(['file_path', 'type'])
            ->useLogName('attachment');
    }

    public function seizedVehicle(): BelongsTo
    {
        return $this->belongsTo(SeizedVehicle::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

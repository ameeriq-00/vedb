<?php

namespace App\Filament\Resources\SeizedVehicleResource\RelationManagers;

use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;

class ActivityLogs extends RelationManager
{
    protected static string $relationship = 'activities';
    protected static ?string $title = 'سجل التعديلات';
    protected static ?string $label = 'سجل تعديل';
    protected static ?string $pluralLabel = 'سجل التعديلات';

    public static function getRelationshipName(): string
    {
        return 'activities';
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('description')->label('العملية'),
            TextColumn::make('causer.name')->label('بواسطة')->default('-'),
            TextColumn::make('properties.attributes')->label('القيم الجديدة')->json()->limit(30),
            TextColumn::make('properties.old')->label('القيم السابقة')->json()->limit(30),
            TextColumn::make('created_at')->label('تاريخ')->date(),
        ])->defaultSort('created_at', 'desc');
    }

    public function canView(Model $record): bool
    {
        /** @var \App\Models\User|null $user */
        $user = auth()->user();
        return $user?->can('view_activity_logs');
    }

    public function canEdit(Model $record): bool
    {
        return false;
    }

    public function canDelete(Model $record): bool
    {
        return false;
    }
}

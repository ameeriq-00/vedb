<?php

namespace App\Filament\Resources\GovernmentVehicleResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class DefectsRelationManager extends RelationManager
{
    protected static string $relationship = 'defects';

    protected static ?string $title = 'العوارض';
    protected static ?string $label = 'عارض';
    protected static ?string $pluralLabel = 'العوارض';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Select::make('defect_id')
                ->label('العطل')
                ->relationship('defect', 'name')
                ->required(),
        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('name')->label('العطل')->searchable(),
        ]);
    }

    public function canEdit(Model $record): bool
    {
        return false;
    }

    public function canDelete(Model $record): bool
    {
        return true;
    }

    public function canCreate(): bool
    {
        return true;
    }
}

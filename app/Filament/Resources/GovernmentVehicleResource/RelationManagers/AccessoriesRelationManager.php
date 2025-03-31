<?php

namespace App\Filament\Resources\GovernmentVehicleResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class AccessoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'accessories';

    protected static ?string $title = 'الملحقات';
    protected static ?string $label = 'ملحق';
    protected static ?string $pluralLabel = 'الملحقات';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Select::make('accessory_id')
                ->label('الملحق')
                ->relationship('accessory', 'name')
                ->required(),
        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('name')->label('الملحق')->searchable(),
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

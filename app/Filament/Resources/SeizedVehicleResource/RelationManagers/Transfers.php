<?php

namespace App\Filament\Resources\SeizedVehicleResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use App\Models\Directorate;

class Transfers extends RelationManager
{
    protected static string $relationship = 'transfers';
    protected static ?string $title = 'المناقلات';
    protected static ?string $label = 'مناقلة';
    protected static ?string $pluralLabel = 'المناقلات';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('recipient_name')
                ->label('اسم المستلم')
                ->required(),

            TextInput::make('recipient_identity_number')
                ->label('رقم هوية المستلم')
                ->required(),

            Select::make('to_directorate_id')
                ->label('المديرية المستلمة')
                ->options(Directorate::all()->pluck('name', 'id'))
                ->searchable()
                ->required(),

            DatePicker::make('transfer_date')
                ->label('تاريخ المناقلة')
                ->required(),
        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('recipient_name')->label('اسم المستلم'),
            TextColumn::make('recipient_identity_number')->label('رقم الهوية'),
            TextColumn::make('toDirectorate.name')->label('المديرية المستلمة'),
            TextColumn::make('user.name')->label('تمت بواسطة'),
            TextColumn::make('transfer_date')->label('تاريخ المناقلة')->date(),
            TextColumn::make('created_at')->label('تاريخ الإضافة')->date(),
        ])->defaultSort('created_at', 'desc');
    }

    public function beforeCreate(): void
    {
        $this->record->user_id = auth()->id();
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

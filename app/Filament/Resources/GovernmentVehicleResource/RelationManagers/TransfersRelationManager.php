<?php

namespace App\Filament\Resources\GovernmentVehicleResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class TransfersRelationManager extends RelationManager
{
    protected static string $relationship = 'transfers';

    protected static ?string $title = 'المناقلات';
    protected static ?string $label = 'مناقلة';
    protected static ?string $pluralLabel = 'المناقلات';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('receiver_name')->label('اسم المستلم')->required(),
            TextInput::make('receiver_id_number')->label('رقم هوية المستلم')->required(),
            TextInput::make('receiver_job_title')->label('العنوان الوظيفي')->nullable(),
            TextInput::make('receiver_directorate')->label('مديرية المستلم')->required(),
            DatePicker::make('transfer_date')->label('تاريخ المناقلة')->required(),
        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('receiver_name')->label('اسم المستلم'),
            TextColumn::make('receiver_id_number')->label('رقم الهوية'),
            TextColumn::make('receiver_job_title')->label('العنوان الوظيفي'),
            TextColumn::make('receiver_directorate')->label('المديرية'),
            TextColumn::make('transfer_date')->label('تاريخ المناقلة')->date(),
        ])->defaultSort('transfer_date', 'desc');
    }

    public function canEdit(Model $record): bool
    {
        return true;
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

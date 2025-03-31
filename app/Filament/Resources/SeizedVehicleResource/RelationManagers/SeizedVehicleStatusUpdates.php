<?php

namespace App\Filament\Resources\SeizedVehicleResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Model;

class SeizedVehicleStatusUpdates extends RelationManager
{
    protected static string $relationship = 'statusUpdates';
    protected static ?string $title = 'سجل الحالة';
    protected static ?string $label = 'تحديث الحالة';
    protected static ?string $pluralLabel = 'تحديثات الحالة';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Select::make('status')
                ->label('المرحلة الجديدة')
                ->options([
                    'مصادرة' => 'مصادرة',
                    'مكتسبة' => 'مكتسبة',
                    'مثمنة' => 'مثمنة',
                    'مصادق عليها' => 'مصادق عليها',
                    'مهداة' => 'مهداة',
                    'مرقمة' => 'مرقمة',
                ])
                ->required(),

            TextInput::make('decision_number')
                ->label('رقم القرار')
                ->required(),

            DatePicker::make('decision_date')
                ->label('تاريخ القرار')
                ->required(),

            FileUpload::make('attachment_path')
                ->label('المرفق')
                ->directory('status-updates')
                ->downloadable()
                ->openable()
                ->preserveFilenames(),
        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('status')
                ->label('المرحلة')
                ->badge(),
            TextColumn::make('decision_number')
                ->label('رقم القرار'),
            TextColumn::make('decision_date')
                ->label('تاريخ القرار')
                ->date(),
            TextColumn::make('user.name')
                ->label('تم بواسطة'),
            ImageColumn::make('attachment_path')
                ->label('المرفق')
                ->disk('public'),
            TextColumn::make('created_at')
                ->label('تاريخ الإدخال')
                ->date(),
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

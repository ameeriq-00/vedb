<?php

namespace App\Filament\Resources\GovernmentVehicleResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Model;

class AttachmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'attachments';

    protected static ?string $title = 'المرفقات';
    protected static ?string $label = 'مرفق';
    protected static ?string $pluralLabel = 'المرفقات';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('اسم المرفق')
                ->required(),

            FileUpload::make('path')
                ->label('الملف')
                ->directory('attachments')
                ->downloadable()
                ->openable()
                ->preserveFilenames(),
        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('name')->label('اسم المرفق'),
            ImageColumn::make('path')->label('الملف')->disk('public'),
            TextColumn::make('created_at')->label('تاريخ الرفع')->dateTime(),
        ])->defaultSort('created_at', 'desc');
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

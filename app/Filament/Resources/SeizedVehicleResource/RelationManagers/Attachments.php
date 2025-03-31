<?php

namespace App\Filament\Resources\SeizedVehicleResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Model;

class Attachments extends RelationManager
{
    protected static string $relationship = 'attachments';
    protected static ?string $title = 'المرفقات';
    protected static ?string $label = 'مرفق';
    protected static ?string $pluralLabel = 'المرفقات';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            TextInput::make('type')
                ->label('نوع المرفق')
                ->maxLength(255),

            FileUpload::make('file_path')
                ->label('الملف')
                ->directory('attachments')
                ->preserveFilenames()
                ->openable()
                ->downloadable()
                ->required(),
        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('type')->label('نوع المرفق')->searchable(),
            ImageColumn::make('file_path')->label('الملف')->disk('public')->downloadable(),
            TextColumn::make('user.name')->label('تم بواسطة'),
            TextColumn::make('created_at')->label('تاريخ الرفع')->date(),
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

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DirectorateResource\Pages;
use App\Models\Directorate;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class DirectorateResource extends Resource
{
    protected static ?string $model = Directorate::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationLabel = 'المديريات';
    protected static ?string $pluralLabel = 'المديريات';
    protected static ?string $label = 'مديرية';
    protected static ?string $navigationGroup = 'الإعدادات';

    protected static ?string $slug = 'directorates';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('اسم المديرية')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('name')->label('اسم المديرية')->searchable()->sortable(),
                TextColumn::make('created_at')->label('تاريخ الإنشاء')->dateTime(),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDirectorates::route('/'),
            'create' => Pages\CreateDirectorate::route('/create'),
            'edit' => Pages\EditDirectorate::route('/{record}/edit'),
        ];
    }
}

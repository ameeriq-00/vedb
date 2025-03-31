<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LegalArticleResource\Pages;
use App\Models\LegalArticle;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class LegalArticleResource extends Resource
{
    protected static ?string $model = LegalArticle::class;

    protected static ?string $navigationIcon = 'heroicon-o-scale';
    protected static ?string $navigationLabel = 'المواد القانونية';
    protected static ?string $pluralLabel = 'المواد القانونية';
    protected static ?string $label = 'مادة قانونية';
    protected static ?string $navigationGroup = 'الإعدادات';

    protected static ?string $slug = 'legal-articles';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('article_number')
                    ->label('رقم المادة')
                    ->required()
                    ->unique()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('وصف المادة')
                    ->rows(3),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('article_number')->label('رقم المادة')->searchable()->sortable(),
                TextColumn::make('description')->label('الوصف')->limit(30),
                TextColumn::make('created_at')->label('تاريخ الإنشاء')->dateTime(),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLegalArticles::route('/'),
            'create' => Pages\CreateLegalArticle::route('/create'),
            'edit' => Pages\EditLegalArticle::route('/{record}/edit'),
        ];
    }
}

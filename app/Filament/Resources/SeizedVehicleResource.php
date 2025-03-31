<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeizedVehicleResource\Pages;
use App\Models\SeizedVehicle;
use App\Models\Directorate;
use App\Models\LegalArticle;
use App\Models\Accessory;
use App\Models\Defect;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\Action;
use App\Filament\Resources\SeizedVehicleResource\RelationManagers\SeizedVehicleStatusUpdates;
use App\Filament\Resources\SeizedVehicleResource\RelationManagers\Attachments;
use App\Filament\Resources\SeizedVehicleResource\RelationManagers\Transfers;
use App\Filament\Resources\SeizedVehicleResource\RelationManagers\EditRequests;
use App\Filament\Resources\SeizedVehicleResource\RelationManagers\ActivityLogs;
use App\Filament\Resources\SeizedVehicleResource\RelationManagers\DefectsRelationManager;
use App\Filament\Resources\SeizedVehicleResource\RelationManagers\AccessoriesRelationManager;


class SeizedVehicleResource extends Resource
{
    protected static ?string $model = SeizedVehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'العجلات المصادرة';
    protected static ?string $pluralLabel = 'العجلات المصادرة';
    protected static ?string $label = 'عجلة مصادرة';
    protected static ?string $navigationGroup = 'العجلات';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('directorate_id')
                    ->label('المديرية')
                    ->options(Directorate::all()->pluck('name', 'id'))
                    ->required(),

                Select::make('legal_article_id')
                    ->label('المادة القانونية')
                    ->options(LegalArticle::all()->pluck('article_number', 'id')),

                TextInput::make('accused_name')->label('اسم المتهم')->required(),
                TextInput::make('vehicle_name')->label('اسم العجلة')->required(),
                TextInput::make('vehicle_number')->label('رقم العجلة')->required(),
                TextInput::make('governorate')->label('المحافظة')->required(),
                TextInput::make('color')->label('لون العجلة')->required(),
                TextInput::make('model')->label('موديل العجلة')->required(),
                TextInput::make('chassis_number')->label('رقم الشاصي')->required(),

                Select::make('condition')
                    ->label('حالة العجلة')
                    ->options(['صالحة' => 'صالحة', 'عاطلة' => 'عاطلة'])
                    ->required(),

                Select::make('status')
                    ->label('مرحلة العجلة')
                    ->options([
                        'محجوزة' => 'محجوزة',
                        'مصادرة' => 'مصادرة',
                        'مكتسبة' => 'مكتسبة',
                        'مثمنة' => 'مثمنة',
                        'مصادق عليها' => 'مصادق عليها',
                        'مهداة' => 'مهداة',
                        'مرقمة' => 'مرقمة',
                    ])
                    ->required(),

                CheckboxList::make('accessories')
                    ->label('الملحقات')
                    ->relationship('accessories', 'name')
                    ->columns(2),

                CheckboxList::make('defects')
                    ->label('العوارض')
                    ->relationship('defects', 'name')
                    ->columns(2),

                Toggle::make('is_released')->label('مفرج عنها؟'),
                Toggle::make('is_external')->label('محالة لجهة خارجية؟'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table

            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('vehicle_number')->label('رقم العجلة')->searchable(),
                TextColumn::make('vehicle_name')->label('اسم العجلة'),
                TextColumn::make('directorate.name')->label('المديرية'),
                BadgeColumn::make('status')->label('المرحلة')->colors([
                    'primary' => 'محجوزة',
                    'warning' => 'مصادرة',
                    'info' => 'مكتسبة',
                    'success' => 'مصادق عليها',
                    'danger' => 'مهداة',
                ]),
                IconColumn::make('is_released')->boolean()->label('مفرج عنها؟'),
                IconColumn::make('is_external')->boolean()->label('محالة خارجياً؟'),
            ])
            ->actions([
                Action::make('transfer')->label('مناقلة')->icon('heroicon-o-arrows-right-left')->requiresConfirmation(),
                Action::make('request_edit')->label('طلب تعديل')->icon('heroicon-o-pencil-square'),
                Action::make('refer')->label('إحالة')->icon('heroicon-o-paper-airplane'),
                Action::make('move')->label('نقل لمديرية')->icon('heroicon-o-building-office'),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            // سنضيف هنا Relation Managers لاحقًا: المرفقات، الحالة، المناقلات...
            SeizedVehicleStatusUpdates::class,
            Attachments::class,
            Transfers::class,
            EditRequests::class,
            ActivityLogs::class,
            AccessoriesRelationManager::class,
            DefectsRelationManager::class,


        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSeizedVehicles::route('/'),
            'create' => Pages\CreateSeizedVehicle::route('/create'),
            'edit' => Pages\EditSeizedVehicle::route('/{record}/edit'),
        ];
    }
}

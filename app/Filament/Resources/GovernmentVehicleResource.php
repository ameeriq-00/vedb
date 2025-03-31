<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GovernmentVehicleResource\Pages;
use App\Models\GovernmentVehicle;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\GovernmentVehicleResource\RelationManagers\AccessoriesRelationManager;
use App\Filament\Resources\GovernmentVehicleResource\RelationManagers\AttachmentsRelationManager;
use App\Filament\Resources\GovernmentVehicleResource\RelationManagers\TransfersRelationManager;
use App\Filament\Resources\GovernmentVehicleResource\RelationManagers\DefectsRelationManager;



class GovernmentVehicleResource extends Resource
{
    protected static ?string $model = GovernmentVehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'العجلات';
    protected static ?string $label = 'عجلة حكومية';
    protected static ?string $pluralLabel = 'العجلات الحكومية';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label('اسم العجلة')->required(),
            Forms\Components\TextInput::make('model')->label('الموديل')->required(),
            Forms\Components\TextInput::make('number')->label('رقم العجلة')->required(),
            Forms\Components\TextInput::make('color')->label('اللون')->required(),
            Forms\Components\TextInput::make('chassis_number')->label('رقم الشاصي')->required(),
            Forms\Components\TextInput::make('condition')->label('الحالة')->required(),
            Forms\Components\Select::make('directorate_id')
                ->label('المديرية')
                ->relationship('directorate', 'name')
                ->required(),
            Forms\Components\TextInput::make('origin_count')->label('عدد الوارد')->numeric(),
            Forms\Components\DatePicker::make('origin_date')->label('تاريخ الوارد'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('الاسم'),
                TextColumn::make('model')->label('الموديل'),
                TextColumn::make('number')->label('الرقم'),
                TextColumn::make('color')->label('اللون'),
                TextColumn::make('condition')->label('الحالة')->badge(),
                TextColumn::make('directorate.name')->label('المديرية'),
                TextColumn::make('origin_count')->label('عدد الوارد'),
                TextColumn::make('origin_date')->label('تاريخ الوارد')->date(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if (! $user?->hasRole('مدير النظام')) {
            $query->where('directorate_id', $user?->directorate_id);
        }

        return $query;
    }
    public static function getRelations(): array
    {
        return [
            // سنضيف هنا Relation Managers لاحقًا: المرفقات، الحالة، المناقلات...
            AccessoriesRelationManager::class,
            AttachmentsRelationManager::class,
            TransfersRelationManager::class,
            DefectsRelationManager::class,


        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGovernmentVehicles::route('/'),
            'create' => Pages\CreateGovernmentVehicle::route('/create'),
            'edit' => Pages\EditGovernmentVehicle::route('/{record}/edit'),
        ];
    }
}

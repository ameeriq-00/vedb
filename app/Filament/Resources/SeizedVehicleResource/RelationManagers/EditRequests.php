<?php

namespace App\Filament\Resources\SeizedVehicleResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class EditRequests extends RelationManager
{
    protected static string $relationship = 'editRequests';
    protected static ?string $title = 'طلبات التعديل';
    protected static ?string $label = 'طلب تعديل';
    protected static ?string $pluralLabel = 'طلبات التعديل';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Select::make('field')
                ->label('الحقل المراد تعديله')
                ->options([
                    'vehicle_name' => 'اسم العجلة',
                    'vehicle_number' => 'رقم العجلة',
                    'color' => 'لون العجلة',
                    'model' => 'موديل العجلة',
                    'condition' => 'الحالة',
                ])
                ->required(),

            TextInput::make('new_value')
                ->label('القيمة الجديدة')
                ->required(),

            Textarea::make('reason')
                ->label('سبب التعديل')
                ->rows(3),
        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('field')->label('الحقل'),
            TextColumn::make('new_value')->label('القيمة الجديدة'),
            TextColumn::make('reason')->label('السبب')->limit(30),
            TextColumn::make('status')
                ->label('الحالة')
                ->badge()
                ->colors([
                    'gray' => 'قيد الانتظار',
                    'success' => 'مقبول',
                    'danger' => 'مرفوض',
                ]),
            TextColumn::make('user.name')->label('مقدم الطلب'),
            TextColumn::make('created_at')->label('تاريخ الطلب')->date(),
        ])->defaultSort('created_at', 'desc');
    }

    public function beforeCreate(): void
    {
        $this->record->user_id = auth()->id();
        $this->record->status = 'pending';
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

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceStationResource\Pages;
use App\Filament\Resources\ServiceStationResource\RelationManagers;
use App\Models\ServiceStation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class ServiceStationResource extends Resource
{
    protected static ?string $model = ServiceStation::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'Service Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('location')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('business_hours')
                            ->maxLength(100)
                            ->placeholder('e.g. Mon-Fri: 9am-5pm, Sat: 10am-2pm'),
                        Forms\Components\Textarea::make('specializations')
                            ->columnSpan(2),
                        Forms\Components\TextInput::make('rating')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(5)
                            ->step(0.1),
                        Forms\Components\Toggle::make('is_verified')
                            ->default(false),
                        Forms\Components\TextInput::make('tax_info')
                            ->maxLength(100),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('contact')
                    ->searchable(),
                Tables\Columns\TextColumn::make('rating')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_verified')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_verified'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
           // RelationManagers\StaffRelationManager::class,
           // RelationManagers\ServiceBaysRelationManager::class,
           // RelationManagers\ServiceRequestsRelationManager::class,
           // RelationManagers\InventoryRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServiceStations::route('/'),
            'create' => Pages\CreateServiceStation::route('/create'),
            'edit' => Pages\EditServiceStation::route('/{record}/edit'),
           // 'view' => Pages\ViewServiceStation::route('/{record}'),
        ];
    }
}
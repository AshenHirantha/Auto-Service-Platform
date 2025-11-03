<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryResource\Pages;
use App\Filament\Resources\InventoryResource\RelationManagers;
use App\Models\Inventory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationGroup = 'Inventory Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('location_id')
                            ->relationship('serviceStation', 'name')
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('item_type')
                            ->options([
                                'Part' => 'Part',
                                'Tool' => 'Tool',
                                'Consumable' => 'Consumable',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('item_id')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('item_name')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('SKU')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('barcode')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('current_stock')
                            ->required()
                            ->default(0)
                            ->numeric(),
                        Forms\Components\TextInput::make('minimum_stock')
                            ->required()
                            ->default(0)
                            ->numeric(),
                        Forms\Components\TextInput::make('reorder_point')
                            ->required()
                            ->default(0)
                            ->numeric(),
                        Forms\Components\TextInput::make('maximum_stock')
                            ->numeric(),
                        Forms\Components\TextInput::make('unit_cost')
                            ->numeric()
                            ->prefix('$'),
                        Forms\Components\TextInput::make('selling_price')
                            ->numeric()
                            ->prefix('$'),
                        Forms\Components\TextInput::make('storage_location')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('condition')
                            ->maxLength(20),
                        Forms\Components\DateTimePicker::make('expiry_date'),
                        Forms\Components\TextInput::make('batch_number')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('quality_status')
                            ->maxLength(20),
                        Forms\Components\DateTimePicker::make('last_stock_check'),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('serviceStation.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('item_type')
                    ->sortable(),
                Tables\Columns\TextColumn::make('item_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('SKU')
                    ->searchable(),
                Tables\Columns\TextColumn::make('current_stock')
                    ->sortable(),
                Tables\Columns\TextColumn::make('minimum_stock')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('reorder_point')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\BadgeColumn::make('stock_status')
                    ->getStateUsing(function (Inventory $record): string {
                        if ($record->current_stock <= 0) {
                            return 'Out of Stock';
                        } elseif ($record->current_stock < $record->minimum_stock) {
                            return 'Low Stock';
                        } elseif ($record->current_stock < $record->reorder_point) {
                            return 'Reorder';
                        } else {
                            return 'In Stock';
                        }
                    })
                    ->colors([
                        'danger' => 'Out of Stock',
                        'warning' => 'Low Stock',
                        'primary' => 'Reorder',
                        'success' => 'In Stock',
                    ]),
                Tables\Columns\TextColumn::make('unit_cost')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('selling_price')
                    ->money('USD')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('item_type')
                    ->options([
                        'Part' => 'Part',
                        'Tool' => 'Tool',
                        'Consumable' => 'Consumable',
                    ]),
                Tables\Filters\SelectFilter::make('location_id')
                    ->relationship('serviceStation', 'name')
                    ->label('Service Station'),
                Tables\Filters\Filter::make('low_stock')
                    ->query(fn (Builder $query): Builder => $query->whereColumn('current_stock', '<', 'minimum_stock'))
                    ->label('Low Stock Items'),
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
            RelationManagers\TransactionsRelationManager::class,
          //  RelationManagers\StockAlertsRelationManager::class,
           // RelationManagers\AuditsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInventories::route('/'),
            'create' => Pages\CreateInventory::route('/create'),
            'edit' => Pages\EditInventory::route('/{record}/edit'),
            'view' => Pages\ViewInventory::route('/{record}'),
        ];
    }
}
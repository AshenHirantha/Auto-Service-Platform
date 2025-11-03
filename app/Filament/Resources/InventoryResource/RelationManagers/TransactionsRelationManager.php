<?php

namespace App\Filament\Resources\InventoryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TransactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'transactions';

    protected static ?string $recordTitleAttribute = 'id';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('transaction_type')
                    ->options([
                        'IN' => 'IN',
                        'OUT' => 'OUT',
                        'ADJUST' => 'ADJUST',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('unit_price')
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('reference_type')
                    ->maxLength(20),
                Forms\Components\TextInput::make('reference_id')
                    ->numeric(),
                Forms\Components\Textarea::make('reason'),
                Forms\Components\TextInput::make('authorized_by')
                    ->maxLength(100),
                Forms\Components\DateTimePicker::make('transaction_date')
                    ->required(),
                Forms\Components\Textarea::make('notes'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaction_type')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'IN' => 'success',
                        'OUT' => 'danger',
                        'ADJUST' => 'warning',
                        default => 'secondary',
                    }),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('unit_price')
                    ->money('USD'),
                Tables\Columns\TextColumn::make('reference_type'),
                Tables\Columns\TextColumn::make('transaction_date')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('authorized_by'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('transaction_type')
                    ->options([
                        'IN' => 'IN',
                        'OUT' => 'OUT',
                        'ADJUST' => 'ADJUST',
                    ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
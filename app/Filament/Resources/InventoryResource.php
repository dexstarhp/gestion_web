<?php

namespace App\Filament\Resources;

use App\Enums\MovementType;
use App\Filament\Personal\Resources\InventoryResource\Pages;
use App\Models\Product;
use App\Models\StockMovement;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;


class InventoryResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationGroup = 'Inventario';

    protected static ?string $label = 'Inventario';
    protected static ?string $navigationIcon = 'heroicon-o-cube';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Producto')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Imagen')
                    ->checkFileExistence(false)
                    ->default(function ($record) {
                        return $record->image_url ? null : 'https://via.placeholder.com/100x100?text=Sin+Imagen';
                    }),

                Tables\Columns\TextColumn::make('current_stock')
                    ->label('Stock Actual')
                    ->formatStateUsing(fn($state) => $state . ' unidades')
                    ->color(fn($state) => $state <= 0 ? 'danger' : ($state <= 5 ? 'warning' : 'success')),
                Tables\Columns\TextColumn::make('average_cost')
                    ->state(fn($record) => $record->average_cost ?? 0)
                    ->label('Costo Prom. Ponderado')
                    ->alignEnd()
                    ->numeric(decimalPlaces: 2),
            ])
            ->actions([
                Tables\Actions\Action::make('ajustarStock')
                    ->tooltip('Ajustar Stock')
                    ->hiddenLabel()
                    ->color('warning')
                    ->icon('heroicon-o-pencil')
                    ->form([
                        TextInput::make('cantidad')
                            ->label('Cantidad a incrementar o reducir (+ / -)')
                            ->numeric()
                            ->required(),
                        TextInput::make('nota')
                            ->label('Nota')
                            ->maxLength(255)
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        $nuevoStock = $record->current_stock + $data['cantidad'];

                        StockMovement::create([
                            'product_id' => $record->id,
                            'movement_type' => MovementType::ADJUSTMENT,
                            'quantity' => $data['cantidad'],
                            'unit_cost' => $record->average_cost, // puedes poner 0 o último costo también
                            'new_stock' => $nuevoStock,
                            'note' => $data['nota'],
                            'date' => now(),
                        ]);
                    }),
                Tables\Actions\Action::make('saldoInicial')
                    ->tooltip('Registrar saldo inicial')
                    ->hiddenLabel()
                    ->color('success') // verde
                    ->icon('heroicon-o-plus-circle')
                    ->visible(fn($record) => $record->stockMovements()->count() === 0) // solo si no tiene movimientos
                    ->form([
                        TextInput::make('cantidad')
                            ->label('Cantidad inicial')
                            ->numeric()
                            ->required(),
                        TextInput::make('costo_unitario')
                            ->label('Costo unitario')
                            ->numeric()
                            ->required(),
                        TextInput::make('nota')
                            ->label('Nota')
                            ->default('Saldo inicial')
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        $quantity = $data['cantidad'];
                        $unitCost = $data['costo_unitario'];

                        $record->stockMovements()->create([
                            'movement_type' => MovementType::ADJUSTMENT,
                            'quantity' => $quantity,
                            'unit_cost' => $unitCost,
                            'new_stock' => $quantity,
                            'note' => $data['nota'],
                            'date' => now(),
                        ]);
                    }),
                Tables\Actions\Action::make('verMovimientos')
                    ->tooltip('Ver movimientos')
                    ->hiddenLabel()
                    ->color('primary')
                    ->icon('heroicon-o-eye')
                    ->url(fn($record) => route('filament.personal.resources.inventories.movement',
                        ['product_id' => $record->id])),
            ])
            ->bulkActions([])
            ->filters([
                Tables\Filters\SelectFilter::make('stock_filter')
                    ->label('Filtrar por stock')
                    ->options([
                        'with_stock' => 'Solo con stock',
                        'zero_stock' => 'Sin stock',
                        'all' => 'Todos',
                    ])
                    ->default('with_stock')
                    ->query(function (Builder $query, array $data): Builder {
                        $query->where('is_service', false);
                        $raw = '
                        COALESCE(
                            (SELECT SUM(
                                CASE
                                    WHEN movement_type IN ("PURCHASE", "ADJUSTMENT") THEN quantity
                                    WHEN movement_type = "SALE" THEN -quantity
                                    ELSE 0
                                END
                            )
                            FROM stock_movements
                            WHERE product_id = products.id),0)';
                        return match ($data['value']) {
                            'with_stock' => $query->whereRaw("{$raw} > 0"),
                            'zero_stock' => $query->WhereRaw("{$raw} <= 0"),
                            default => $query,
                        };
                    })
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInventories::route('/'),
            'movement' => Pages\ViewStockMovements::route('/{product_id}/movement'),
        ];
    }
}

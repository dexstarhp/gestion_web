<?php

namespace App\Filament\Personal\Resources\InventoryResource\Pages;

use App\Filament\Personal\Resources\InventoryResource;
use App\Models\Product;
use App\Models\StockMovement;
use App\Utils\AverageCostUtility;
use Filament\Resources\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class ViewStockMovements extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $model = StockMovement::class;

    protected static string $resource = InventoryResource::class;

    protected static string $view = 'filament.personal.resources.inventory-resource.pages.view-stock-movements';

    public ?Product $product = null;
    protected static ?string $title = 'Movimientos de Producto';

    public function mount($product_id): void
    {
        $this->product = Product::find($product_id);
    }

    public function table(Table $table): Table
    {

        return $table
            ->query(StockMovement::where('product_id', $this->product->id)->orderBy('date')
            )
            ->description('Movimiento del producto ' . $this->product->name)
            ->columns([
                TextColumn::make('date')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i'),

                TextColumn::make('movement_type')
                    ->label('Tipo')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'PURCHASE' => 'COMPRA',
                        'SALE' => 'VENTA',
                        'ADJUSTMENT' => 'AJUSTE',
                        default => $state
                    }),
                /* Entradas */
                TextColumn::make('quantity_in')
                    ->label('Cantidad Entradas')
                    ->alignEnd()
                    ->color('info')
                    ->numeric()
                    ->state(function ($record) {
                        if ($record->movement_type == 'PURCHASE') {
                            return $record->quantity;
                        }
                        return null;
                    }),
                TextColumn::make('unit_cost_in')
                    ->label('Costo unitario Entradas')
                    ->alignEnd()
                    ->numeric(decimalPlaces: 2)
                    ->state(function ($record) {
                        return in_array($record->movement_type, ['PURCHASE'])
                            ? $record->unit_cost
                            : null;
                    }),
                TextColumn::make('total_cost_in')
                    ->label('Costo total entradas')
                    ->numeric(decimalPlaces: 2)
                    ->alignEnd()
                    ->state(function ($record) {
                        return in_array($record->movement_type, ['PURCHASE',])
                            ? $record->quantity * $record->unit_cost
                            : null;
                    }),

                /*Salidas*/
                TextColumn::make('quantity')
                    ->label('Cantidad Salidas')
                    ->alignEnd()
                    ->numeric()
                    ->state(function ($record) {
                        if ($record->movement_type == 'SALE') {
                            return $record->quantity;
                        }
                        return null;
                    }),
                TextColumn::make('unit_cost')
                    ->label('Costo unitario salidas')
                    ->alignEnd()
                    ->numeric(decimalPlaces: 2)
                    ->state(function ($record) {
                        return in_array($record->movement_type, ['SALE'])
                            ? $record->unit_cost
                            : null;
                    }),
                TextColumn::make('Costo total salidas')
                    ->label('Costo total salidas')
                    ->numeric(decimalPlaces: 2)
                    ->alignEnd()
                    ->state(function ($record) {
                        return in_array($record->movement_type, ['SALE',])
                            ? $record->quantity * $record->unit_cost
                            : null;
                    }),

                /*Existencias*/
                TextColumn::make('total_quantity')
                    ->label('Cantitad total')
                    ->numeric()
                    ->alignEnd()
                    ->state(function ($record) {
                        return AverageCostUtility::getTotalQuantity($this->product->id, $record->date);
                    }),
                TextColumn::make('total_unit_cost')
                    ->label('Costo unitario')
                    ->numeric(decimalPlaces: 2)
                    ->alignEnd()
                    ->state(function ($record) {
                        return AverageCostUtility::getTotalUnitCost($this->product->id, $record->date);
                    }),
                TextColumn::make('total_cost')
                    ->label('Costo total')
                    ->numeric(decimalPlaces: 2)
                    ->alignEnd()
                    ->state(function ($record) {
                        return AverageCostUtility::getTotalCost($this->product->id, $record->date);
                    }),
            ])
            ->striped();
    }
}

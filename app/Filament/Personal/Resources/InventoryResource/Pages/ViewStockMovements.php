<?php

namespace App\Filament\Personal\Resources\InventoryResource\Pages;

use App\Filament\Personal\Resources\InventoryResource;
use App\Models\Product;
use App\Models\StockMovement;
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
            ->query(StockMovement::where('product_id', $this->product->id)->orderByDesc('date'))
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

                TextColumn::make('quantity')
                    ->label('Cantidad'),

                TextColumn::make('entrada')
                    ->label('Entrada')
                    ->state(function ($record) {
                        return in_array($record->movement_type, ['PURCHASE', 'ADJUSTMENT']) && $record->quantity > 0
                            ? $record->quantity
                            : null;
                    }),
                TextColumn::make('salida')
                    ->label('Salida')
                    ->state(function ($record) {
                        return in_array($record->movement_type, ['SALE', 'ADJUSTMENT']) && $record->quantity < 0
                            ? abs($record->quantity)
                            : null;
                    }),
                TextColumn::make('total_entrada')
                    ->label('Costo Total Entrada')
                    ->money('BOB', locale: 'es')
                    ->state(function ($record) {
                        return in_array($record->movement_type, ['PURCHASE', 'ADJUSTMENT']) && $record->quantity > 0
                            ? $record->quantity * $record->unit_cost
                            : null;
                    }),
                TextColumn::make('total_salida')
                    ->label('Costo Total Salida')
                    ->money('BOB', locale: 'es')
                    ->state(function ($record) {
                        return in_array($record->movement_type, ['SALE', 'ADJUSTMENT']) && $record->quantity < 0
                            ? abs($record->quantity * $record->unit_cost)
                            : null;
                    }),
                TextColumn::make('new_stock')
                    ->label('Stock Final'),
                TextColumn::make('note')
                    ->label('Nota')
                    ->limit(50),
            ]);
    }
}

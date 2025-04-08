<?php

namespace App\Filament\Personal\Resources;

use App\Filament\Personal\Resources\ProductSalePriceResource\Pages;
use App\Filament\Personal\Resources\ProductSalePriceResource\RelationManagers;
use App\Models\Product;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductSalePriceResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationGroup = 'Gestión Ventas';
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Precios de Venta';
    protected static ?string $pluralModelLabel = 'Precios de Venta';

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
                Tables\Columns\TextColumn::make('name')->label('Producto')->searchable(),
                Tables\Columns\TextColumn::make('current_sale_price')->label('Precio Venta')->money('BOB'),
                Tables\Columns\IconColumn::make('is_sellable')->label('¿Vendible?')->boolean(),
            ])
            ->actions([
                Tables\Actions\Action::make('Editar Precio')
                    ->icon('heroicon-o-pencil-square')
                    ->form([
                        TextInput::make('current_sale_price')
                            ->label('Precio de Venta')
                            ->numeric()
                            ->required()
                            ->prefix('Bs.')
                            ->rules(fn($record) => ['gte:' . $record->average_cost])
                            ->helperText(fn($record) => 'Costo promedio: Bs. ' . number_format($record->average_cost,
                                    2)),
                        Toggle::make('is_sellable')->label('¿Es vendible?'),
                    ])
                    ->action(function (array $data, Product $record) {
                        $record->update($data);
                    })
                    ->modalHeading('Editar precio de venta'),
            ])
            ->headerActions([
                Tables\Actions\Action::make('Habilitar productos para venta')
                    ->icon('heroicon-o-check-circle')
                    ->label('Habilitar Vendibles')
                    ->modalHeading('Seleccionar productos a habilitar')
                    ->action(function () {
                        // Aquí puedes abrir un modal con productos no vendibles para habilitarlos
                    })
                    ->requiresConfirmation()
                    ->color('success'),
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
            'index' => Pages\ListProductSalePrices::route('/'),
            'create' => Pages\CreateProductSalePrice::route('/create'),
            'edit' => Pages\EditProductSalePrice::route('/{record}/edit'),
        ];
    }
}

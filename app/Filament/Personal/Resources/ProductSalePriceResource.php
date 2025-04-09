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
                Tables\Columns\TextColumn::make('name')
                    ->label('Producto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Descripción')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Imagen')
                    ->circular()
                    ->defaultImageUrl(
                        fn($record) => public_path('app/default/no-image.jpg')
                    )
                    ->getStateUsing(
                        fn($record) => $record->image_url ?: null
                    ),

                Tables\Columns\TextColumn::make('current_sale_price')
                    ->label('Precio Venta')
                    ->money('BOB'),
                Tables\Columns\IconColumn::make('is_sellable')
                    ->label('¿Vendible?')
                    ->boolean(),
            ])
            ->actions([
                Tables\Actions\Action::make('Editar Precio')
                    ->icon('heroicon-o-pencil-square')
                    ->tooltip('Editar precio de venta')
                    ->form([
                        TextInput::make('current_sale_price')
                            ->label('Precio de Venta')
                            ->numeric()
                            ->required()
                            ->prefix('Bs.')
                            ->rules(fn($record) => ['gte:' . $record->average_cost])
                            ->helperText(
                                fn($record) => 'Costo unitario: Bs. ' . number_format($record->average_cost,
                                        2)
                            ),
                        Toggle::make('is_sellable')
                            ->label('¿Es vendible?(Si da un precio de venta  se pondra se habilitara para la venta)')
                            ->default(true),
                    ])
                    ->action(function (array $data, Product $record) {
                        $record->update([
                            'current_sale_price' => $data['current_sale_price'],
                            'is_sellable' => true,
                        ]);
                    })
                    ->modalHeading('Editar precio de venta')
                    ->color('warning')
                    ->label('')
                    ->visible(fn($record) => $record->average_cost > 0),

                Tables\Actions\Action::make('habilitarVenta')
                    ->icon('heroicon-o-check-circle')
                    ->tooltip('Habilitar para venta')
                    ->modalHeading('¿Habilitar para la venta?')
                    ->color('success')
                    ->visible(fn($record) => !$record->is_sellable)
                    ->requiresConfirmation()
                    ->label('')
                    ->action(function (array $data, Product $record) {
                        $record->update([
                            'is_sellable' => true,
                        ]);
                    }),

            ])
            ->headerActions([

            ])
            ->recordUrl(null)
            ->filters([
                Tables\Filters\SelectFilter::make('is_sellable')
                    ->label('¿Vendible?')
                    ->options([
                        '1' => 'Vendible',
                        '0' => 'No vendible',
                    ])
                    ->default(1)
                    ->placeholder('Todos'),
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

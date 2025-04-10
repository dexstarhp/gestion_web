<?php

namespace App\Filament\Personal\Resources;

use App\Filament\Personal\Resources\ProductSalePriceResource\Pages;
use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Http\UploadedFile;

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
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),

                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Imagen')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->defaultImageUrl(url('app/default/no-image.jpg')),
                Tables\Columns\TextColumn::make('unit_cost')
                    ->label('Costo')
                    ->state(fn($record) => $record->average_cost ?? 0)
                    ->money('BOB')
                    ->alignEnd()
                    ->description(function ($record) {
                        return ($record->average_cost ?? 0) <= 0
                            ? 'Ir a Inventarios para inicializar saldos'
                            : null;
                    }),
                Tables\Columns\TextColumn::make('stock')
                    ->label('Cantidad')
                    ->state(fn($record) => $record->current_stock ?? 0)
                    ->numeric()
                    ->alignEnd(),
                Tables\Columns\TextColumn::make('current_sale_price')
                    ->label('Precio Venta')
                    ->money('BOB')
                    ->alignEnd(),
                Tables\Columns\IconColumn::make('is_sellable')
                    ->label('¿Vendible?')
                    ->alignCenter()
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_service')
                    ->label('¿Es Servicio?')
                    ->alignCenter()
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
                    ->visible(function ($record) {
                        return $record->is_service || ($record->average_cost > 0 && $record->current_stock > 0);
                    }),

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
                Tables\Actions\Action::make('addProduct')
                    ->label('Registrar Producto')
                    ->icon('heroicon-o-plus')
                    ->modalHeading('Registrar nuevo producto')
                    ->form([
                        TextInput::make('name')
                            ->label('Nombre del Producto')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('description')
                            ->label('Descripción')
                            ->maxLength(255),
                        FileUpload::make('image_url')
                            ->label('Imagen')
                            ->image()
                            ->imageEditor()
                            ->directory('images/products'),
                        TextInput::make('current_sale_price')
                            ->label('Precio de Venta')
                            ->required()
                            ->numeric()
                            ->prefix('Bs.'),
                        Toggle::make('is_sellable')
                            ->label('¿Es vendible?')
                            ->default(true),
                    ])
                    ->modalButton('Registrar Producto')
                    ->action(function (array $data) {
                        $imagePath = $data['image_url'] ?? null;

                        // Si es una instancia de UploadedFile, obtenemos el path
                        if ($imagePath instanceof UploadedFile) {
                            $imagePath = $imagePath->store('images/products', 'public');
                        }

                        Product::create([
                            'name' => $data['name'],
                            'description' => $data['description'],
                            'image_url' => $imagePath,
                            'current_sale_price' => $data['current_sale_price'],
                            'is_sellable' => $data['is_sellable'],
                            'user_id' => auth()->id(),
                        ]);
                    })
                    ->color('success'),
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

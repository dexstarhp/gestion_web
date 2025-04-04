<?php

namespace App\Filament\Personal\Resources;

use App\Enums\DocumentType;
use App\Filament\Personal\Resources\PurchaseResource\Pages;
use App\Models\Product;
use App\Models\Purchase;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class PurchaseResource extends Resource
{
    protected static ?string $model = Purchase::class;
    protected static ?string $modelLabel = 'Compra';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)->schema([
                    DatePicker::make('date')
                        ->label('Fecha de compra')
                        ->default(now())
                        ->required(),
                    Select::make('supplier_id')
                        ->label('Proveedor')
                        ->relationship('supplier', 'name')
                        ->searchable()
                        ->createOptionForm([
                            TextInput::make('name')
                                ->label('Nombre')
                                ->required()
                                ->maxLength(70),
                            Select::make('document_type')
                                ->label('Tipo de Documento')
                                ->options(
                                    collect(DocumentType::cases())
                                        ->mapWithKeys(
                                            fn($documentType) => [$documentType->value => $documentType->label()]
                                        )->toArray(),
                                )
                                ->required(),
                            TextInput::make('document_number')
                                ->label('Número de documento')
                                ->maxLength(30),
                            TextInput::make('phone')
                                ->label('Telefono')
                                ->tel()
                                ->maxLength(8),
                            Hidden::make('user_id')
                                ->default(Auth::id()),

                        ])
                        ->preload()
                        ->required(),
                    TextInput::make('total')
                        ->required()
                        ->numeric()
                        ->readOnly()
                        ->prefix('Bs.') // Agregar prefijo de moneda (opcional)
                        ->extraInputAttributes(['style' => 'text-align: right']) // Alinear a la derecha
                        ->default(0.00),
                ]),
                Grid::make(1)->schema([
                    Textarea::make('description')
                        ->label('Descripciòn')
                        ->required()
                        ->columnSpanFull(),
                ]),
                TableRepeater::make('purchaseDetails')
                    ->relationship('purchaseDetails') // Asegúrate de tener la relación configurada en el modelo
                    ->columnSpanFull()
                    ->streamlined()
                    ->headers([
                        Header::make('Producto')
                            ->markAsRequired()
                            ->width('40%'),
                        Header::make('Precio Unitario')
                            ->align(Alignment::Right)
                            ->markAsRequired(),
                        Header::make('Cantidad')
                            ->align(Alignment::Right)
                            ->markAsRequired(),
                        Header::make('Subtotal')
                            ->align(Alignment::Right)
                            ->markAsRequired(),
                    ])
                    ->label('Detalles de compra')
                    ->schema([
                        Select::make('product_id')
                            ->searchable()
                            ->selectablePlaceholder(false)
                            ->label('Producto')
                            ->options(Product::all()->pluck('name', 'id'))
                            ->required(),

                        TextInput::make('unit_price')
                            ->label('Precio unitario')
                            ->numeric()
                            ->inputMode('decimal')
                            ->live(debounce: 500) // Agrega un retraso para evitar errores al escribir
                            ->required()
                            ->default(0)
                            ->prefix('Bs.') // Agregar prefijo de moneda (opcional)
                            ->extraInputAttributes(['style' => 'text-align: right']) // Alinear a la derecha
                            ->afterStateUpdated(fn($state, callable $set, callable $get) => $set('subtotal',
                                is_numeric($state) && is_numeric($get('quantity'))
                                    ? number_format((float)$get('quantity') * (float)$state, 2, '.', '')
                                    : 0)
                            ),

                        TextInput::make('quantity')
                            ->numeric()
                            ->label('Cantidad')
                            ->required()
                            ->default(0)
                            ->live(debounce: 500) // Agrega un retraso para evitar errores al escribir
                            ->extraInputAttributes(['style' => 'text-align: right']) // Alinear a la derecha
                            ->afterStateUpdated(fn($state, callable $set, callable $get) => $set('subtotal',
                                is_numeric($state) && is_numeric($get('unit_price'))
                                    ? number_format((float)$get('unit_price') * (float)$state, 2, '.', '')
                                    : 0)
                            ),
                        TextInput::make('subtotal')
                            ->label('Subtotal')
                            ->numeric()
                            ->inputMode('decimal')
                            ->extraInputAttributes(['style' => 'text-align: right']) // Alinear a la derecha
                            ->readOnly(),
                    ])
                    ->addActionLabel('Agregar Producto') // Personaliza el botón de agregar fila
                    ->afterStateUpdated(fn($state, callable $set) => $set('total', round(
                        collect($state ?? [])->sum(fn($detail
                        ) => ($detail['unit_price'] ?? 0) * ($detail['quantity'] ?? 0)
                        ), 2))
                    ),
                Hidden::make('user_id')
                    ->default(Auth::id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date')
                    ->label('Fecha')
                    ->date()
                    ->sortable(),
                TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('supplier.name')
                    ->label('Proveedor')
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Registrado por')
                    ->numeric()
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPurchases::route('/'),
            'create' => Pages\CreatePurchase::route('/create'),
            'edit' => Pages\EditPurchase::route('/{record}/edit'),
        ];
    }
}

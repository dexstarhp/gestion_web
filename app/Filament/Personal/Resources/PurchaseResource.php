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
                        ->required(),
                    TextInput::make('total')
                        ->required()
                        ->numeric()
                        ->readOnly()
                        ->default(0.00),
                ]),
                Grid::make(1)->schema([
                    Textarea::make('description')
                        ->label('Descripciòn')
                        ->required()
                        ->columnSpanFull(),
                ]),
                /*Repeater::make('purchaseDetails')
                    ->label('Productos')
                    ->columnSpanFull()
                    ->relationship('purchaseDetails')
                    ->schema([
                        Grid::make(4)->schema([
                            Select::make('product_id')
                                ->label('Producto')
                                ->options(Product::all()->pluck('name', 'id'))
                                ->required()
                                ->columnSpan(2),

                            TextInput::make('unit_price')
                                ->label('Precio unitario')
                                ->numeric()
                                ->required()
                                ->columnSpan(1),

                            TextInput::make('quantity')
                                ->numeric()
                                ->label('Cantidad')
                                ->required()
                                ->columnSpan(1),
                        ])
                    ])
                    ->afterStateUpdated(fn($state, callable $set) => $set('total',
                        collect($state)->sum(fn($detail) => $detail['unit_price'] * $detail['quantity']))
                    ),*/
                TableRepeater::make('purchaseDetails')
                    ->columnSpanFull()
                    ->headers([
                        Header::make('Producto')->width('150px'),
                        Header::make('Precio Unitario')->width('150px'),
                        Header::make('Cantidad')->width('150px'),
                        Header::make('Subtotal')->width('150px'),
                    ])
                    ->label('Detalles de compra')
                    ->relationship('purchaseDetails') // Asegúrate de tener la relación configurada en el modelo
                    ->schema([
                        Select::make('product_id')
                            ->label('Producto')
                            ->options(Product::all()->pluck('name', 'id'))
                            ->required(),

                        TextInput::make('unit_price')
                            ->label('Precio unitario')
                            ->numeric()
                            ->required(),

                        TextInput::make('quantity')
                            ->numeric()
                            ->label('Cantidad')
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn($state, callable $set, callable $get) => $set('subtotal',
                                number_format($get('unit_price') * $state, 2))
                            ),

                        TextInput::make('subtotal')
                            ->label('Subtotal')
                            ->numeric()
                            ->readOnly(),
                    ])
                    ->addActionLabel('Agregar Producto') // Personaliza el botón de agregar fila
                    ->afterStateUpdated(fn($state, callable $set) => $set('total',
                        collect($state ?? [])->sum(fn($detail
                        ) => ($detail['unit_price'] ?? 0) * ($detail['quantity'] ?? 0)))
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

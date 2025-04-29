<?php

namespace App\Filament\Resources;

use App\Filament\Personal\Resources\SaleResource\Pages;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;
    protected static ?string $modelLabel = 'Venta';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Gestión Ventas';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)->schema([
                    Forms\Components\DatePicker::make('date')
                        ->label('Fecha de Venta')
                        ->default(now())
                        ->required(),
                    Forms\Components\Select::make('customer_id')
                        ->label('Cliente')
                        ->relationship('customer', 'name')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->placeholder('Seleccione un cliente')
                        ->getSearchResultsUsing(function (string $search) {
                            return Customer::query()
                                ->where('name', 'like', "%{$search}%")
                                ->orWhere('document_number', 'like', "%{$search}%")
                                ->limit(20)
                                ->pluck('name', 'id');
                        })
                        ->getOptionLabelUsing(fn($value) => Customer::find($value)?->name)
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')
                                ->label('Nombre')
                                ->required(),
                            Forms\Components\TextInput::make('document_number')
                                ->label('N° Documento')
                                ->required()
                        ])
                        ->createOptionAction(function (\Filament\Forms\Components\Actions\Action $action) {
                            return $action
                                ->modalHeading('Registrar nuevo cliente')
                                ->modalButton('Guardar')
                                ->closeModalByClickingAway(false);
                        }),

                    Forms\Components\TextInput::make('total')
                        ->label('Total')
                        ->required()
                        ->numeric()
                        ->readOnly()
                        ->prefix('Bs.')
                        ->default(0.00)
                        ->extraInputAttributes(['style' => 'text-align: right']),
                ]),
                Forms\Components\Grid::make(1)->schema([
                    Forms\Components\Textarea::make('description')
                        ->label('Descripción')
                        ->required()
                        ->columnSpanFull(),
                ]),

                TableRepeater::make('saleDetails')
                    ->relationship('saleDetails')
                    ->columnSpanFull()
                    ->streamlined()
                    ->headers([
                        Header::make('Producto')
                            ->markAsRequired()->width('40%'),
                        Header::make('Precio Unitario')->align(Alignment::Right)->markAsRequired(),
                        Header::make('Cantidad')->align(Alignment::Right)->markAsRequired(),
                        Header::make('Subtotal')->align(Alignment::Right)->markAsRequired(),
                    ])
                    ->label('Detalle de Venta')
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->searchable()
                            ->placeholder('Seleccione un producto')
                            ->options(Product::where('is_sellable', true)->pluck('name', 'id'))
                            ->required()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                if ($state) {
                                    $product = Product::find($state); // Buscar el producto por ID
                                    if ($product) {
                                        $set('unit_price',
                                            $product->current_sale_price); // Establecer el precio unitario
                                    }
                                }
                            }),

                        Forms\Components\TextInput::make('unit_price')
                            ->label('Precio Unitario')
                            ->numeric()
                            ->inputMode('decimal')
                            ->live()
                            ->required()
                            ->default(0)
                            ->prefix('Bs.')
                            ->readonly()
                            ->extraInputAttributes(['style' => 'text-align: right'])
                            ->afterStateUpdated(fn($state, callable $set, callable $get) => $set('subtotal',
                                is_numeric($state) && is_numeric($get('quantity'))
                                    ? number_format((float)$get('quantity') * (float)$state, 2, '.', '')
                                    : 0)
                            ),

                        Forms\Components\TextInput::make('quantity')
                            ->numeric()
                            ->label('Cantidad')
                            ->required()
                            ->default(0)
                            ->live(debounce: 500)
                            ->extraInputAttributes(['style' => 'text-align: right'])
                            ->afterStateUpdated(fn($state, callable $set, callable $get) => $set('subtotal',
                                is_numeric($state) && is_numeric($get('unit_price'))
                                    ? number_format((float)$get('unit_price') * (float)$state, 2, '.', '')
                                    : 0)
                            ),

                        Forms\Components\TextInput::make('subtotal')
                            ->numeric()
                            ->inputMode('decimal')
                            ->extraInputAttributes(['style' => 'text-align: right'])
                            ->readOnly(),
                    ])
                    ->addActionLabel('Agregar Producto')
                    ->afterStateUpdated(fn($state, callable $set) => $set('total', round(
                        collect($state ?? [])->sum(fn($detail
                        ) => ($detail['unit_price'] ?? 0) * ($detail['quantity'] ?? 0)), 2))
                    ),
                Forms\Components\Hidden::make('user_id')
                    ->default(Auth::id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->label('Fecha')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Cliente')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->prefix('Bs.')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
        ];
    }
}

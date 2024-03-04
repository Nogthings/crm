<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'gmdi-inventory-2-o';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')
                    ->label('Name')
                    ->required(),
                Select::make('category_id')
                    ->label('Category')
                    ->options(fn () => \App\Models\Category::pluck('name', 'id'))
                    ->required()
                    ->searchable(),
                TextArea::make('description')
                    ->label('Description')
                    ->required()
                    ->rows(3),
                TextInput::make('sku')
                    ->label('SKU')
                    ->required(),
                TextInput::make('barcode')
                    ->label('Barcode')
                    ->required(),
                Select::make('brand')
                    ->label('Brand')
                    ->required()
                    ->options(fn () => \App\Models\Brand::pluck('name', 'id'))
                    ->searchable(),
                TextInput::make('model')
                    ->label('Model')
                    ->required(),
                TextInput::make('unit')
                    ->label('Unit')
                    ->required(),
                TextInput::make('price')
                    ->label('Price')
                    ->required(),
                TextInput::make('alert_quantity')
                    ->label('Alert Quantity')
                    ->required(),
                Checkbox::make('is_expirable')
                    ->label('Is Expirable')
                    ->live(),
                DatePicker::make('expires_at')
                    ->label('Expiration Date')
                    ->hidden(fn (Get $get): bool => ! $get('is_expirable')),
                FileUpload::make('image')
                    ->label('Image')
                    ->disk('public')
                    ->directory('products')
                    ->image()
                    ->imageEditorViewportWidth('150')
                    ->imageEditorViewportHeight('150')
                    ->previewable(),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')
                    ->label('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Description')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('barcode')
                    ->label('Barcode')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('brand')
                    ->label('Brand')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('model')
                    ->label('Model')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('unit')
                    ->label('Unit')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Price')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('quantity')
                    ->label('Quantity')
                    ->searchable()
                    ->sortable(),
                ImageColumn::make('image')
                    ->label('Image'),
                TextColumn::make('status')
                    ->label('Status')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('is_expirable')
                    ->label('Is Expirable')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('expires_date')
                    ->label('Expiration Day')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

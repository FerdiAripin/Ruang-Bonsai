<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
// use Laravel\Prompts\select;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
// use App\Fi   lament\Resources\ProductResource\RelationManagersts\select;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = "Produk";
    protected static ?string $modelLabel = "Produk";
    protected static ?string $slug = "produk";


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('categories_id')
                ->label('Kategori')
                    ->relationship('categories', 'categories_name')
                    ->required(),

                TextInput::make('name')
                    ->label('Nama Produk')
                    ->required(),

                TextInput::make('stock')
                    ->label('Stok')
                    ->required()
                    ->numeric(),

                TextInput::make('price')
                    ->label('Harga')
                    ->required()
                    ->numeric(),

                TextInput::make('discount')
                    ->label('Diskon (%)')
                    ->numeric()
                    ->suffix('%')
                    ->minValue(0)
                    ->maxValue(100)
                    ->nullable(),


                Textarea::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull()
                    ->nullable(),


                FileUpload::make('image')
                    ->label('Gambar')
                    ->columnSpanFull()
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('categories.categories_name')
                    ->label('Nama Kategori'),

                TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->shortable(),

                TextColumn::make('stock')
                    ->label('Stok'),

                TextColumn::make('price')
                    ->label('Harga'),
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

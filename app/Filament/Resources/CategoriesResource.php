<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Categories;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CategoriesResource\Pages;
use App\Filament\Resources\CategoriesResource\RelationManagers;

class CategoriesResource extends Resource
{
    protected static ?string $model = Categories::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = "Kategori Produk";
    protected static ?string $modelLabel = "Kategori Produk";
    protected static ?string $slug = "kategori-produk";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('categories_name')

                    ->label('Nama Kategori')
                    ->required(),

                FileUpload::make('image')
                    ->label('Gambar')
                    ->columnSpanFull()
                    ->required(),

                TextInput::make('description')
                    ->label('Deskripsi')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('categories_name')
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable(),

                ImageColumn::make('image')
                    ->label('Gambar')
                    ->circular(),

                TextColumn::make('description')
                    ->label('Deskripsi')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCategories::route('/'),
        ];
    }
}

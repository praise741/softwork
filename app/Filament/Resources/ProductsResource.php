<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductsResource\Pages;
use App\Models\category;
use App\Models\Products;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ProductsResource extends Resource
{
    protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['profit'] = $this -> sellingprice + $this -> costprice;

    return $data;
}
    protected static ?string $model = Products::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Select::make('category')
                    ->label('category')
                    ->options(category::all()->pluck('category','category'))
                    ->searchable(),
                Forms\Components\TextInput::make('costprice')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('sellingprice')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('profit')
                    ->required()
                    ->maxLength(255),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('category'),
                Tables\Columns\TextColumn::make('costprice'),
                Tables\Columns\TextColumn::make('sellingprice'),
                Tables\Columns\TextColumn::make('profit'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageProducts::route('/'),
        ];
    }
}

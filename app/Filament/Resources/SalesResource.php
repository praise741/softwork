<?php

namespace App\Filament\Resources;
use App\Filament\Resources\SalesResource\Widgets\praise;

use App\Filament\Resources\SalesResource\Pages;
use App\Models\category;
use App\Models\products;
use App\Models\Sales;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class SalesResource extends Resource

{
    public static function getRelations(): array
{
    return [
        RelationManagers\PostsRelationManager::class,
    ];
}
    protected static ?string $model = Sales::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('name')
                    ->label('Purpose')
                    ->options(products::all()->pluck('name','name'))
                    ->searchable(),
                    Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->helperText('Your full name here, including any middle names.'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ]);
    }
    protected function getHeaderWidgets(): array
{
    return [
        praise::class
    ];
}


    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSales::route('/'),
        ];
    }
}

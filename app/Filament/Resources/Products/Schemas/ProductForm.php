<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name') // 'category' is the relationship method in Product model, 'name' is the display column
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('stock')
                    ->required()
                    ->numeric(),
                FileUpload::make('main_image')
                    ->label('main_image')
                    ->image()
                    
                    ->directory('products/images')
                    ->required(),
                FileUpload::make('images')
                    ->label('Gallery')
                    ->image()
                    ->multiple()
                    ->directory('products/gallery')
                    ->reorderable()
                    ->required(),
                Toggle::make('active')
                    ->required(),
            ]);
    }
}

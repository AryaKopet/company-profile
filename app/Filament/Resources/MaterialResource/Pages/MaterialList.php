<?php

namespace App\Filament\Resources\MaterialResource\Pages;

use Filament\Resources\Pages\ManageRecords;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\MaterialResource;

class MaterialList extends ManageRecords
{
    protected static ?string $navigationIcon = 'heroicon-o-eye';
    protected static string $resource = MaterialResource::class;

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('id')->label('ID')->sortable(),
            TextColumn::make('barang')->label('Nama Barang')->sortable(),
            TextColumn::make('harga')->label('Harga')->sortable(),
            TextColumn::make('created_at')->label('Tanggal Dibuat')->dateTime()->sortable(),
        ];
    }
}

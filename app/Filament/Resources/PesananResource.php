<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesananResource\Pages;
use App\Filament\Resources\PesananResource\RelationManagers;
use App\Models\Pesanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;
    protected static ?string $navigationLabel = 'Pesanan';
    protected static ?string $navigationIcon = 'heroicon-m-shopping-bag';
    protected static ?string $navigationGroup = 'Customers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                ->required()
                ->email()
                ->maxLength(255),
            Forms\Components\Select::make('bahan_material')
                ->options([
                    'impraboard_t3' => 'Impraboard T3',
                    'impraboard_t5' => 'Impraboard T5',
                    'kardus' => 'Kardus',
                ])
                ->required(),
            Forms\Components\Select::make('frame')
                ->options([
                    'frame_injection' => 'Frame Injection',
                    'frame_aluminium' => 'Frame Aluminium',
                ])
                ->required(),
            Forms\Components\TextInput::make('panjang')
                ->required()
                ->numeric(),
            Forms\Components\TextInput::make('lebar')
                ->required()
                ->numeric(),
            Forms\Components\TextInput::make('tinggi')
                ->required()
                ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_pesanan')->label('ID Pesanan')->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('bahan_material')->label('Bahan Material'),
                Tables\Columns\TextColumn::make('frame')->label('Frame'),
                Tables\Columns\TextColumn::make('panjang')->label('Panjang (cm)'),
                Tables\Columns\TextColumn::make('lebar')->label('Lebar (cm)'),
                Tables\Columns\TextColumn::make('tinggi')->label('Tinggi (cm)'),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat Pada')->dateTime('d M Y H:i'),
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
            'index' => Pages\ListPesanans::route('/'),
            'create' => Pages\CreatePesanan::route('/create'),
            'edit' => Pages\EditPesanan::route('/{record}/edit'),
        ];
    }
}

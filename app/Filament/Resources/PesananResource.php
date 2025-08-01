<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesananResource\Pages;
use App\Models\Pesanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\URL;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;
    protected static ?string $navigationLabel = 'Pesanan';
    protected static ?string $navigationIcon = 'heroicon-m-shopping-bag';
    public static function getNavigationBadge(): ?string
    {
        return Pesanan::count();
    }
    protected static ?string $navigationGroup = 'Shop';

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
                Forms\Components\TextInput::make('lokasi')
                    ->required()
                    ->string(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_pesanan')->label('ID Pesanan')->sortable(),
                Tables\Columns\TextColumn::make('email')->label('Email Pelanggan')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nama_box')->label('Nama Box/Projek/Partisi')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('bahan_material')->label('Bahan Material'),
                Tables\Columns\TextColumn::make('frame')->label('Frame'),
                Tables\Columns\TextColumn::make('panjang')->label('Panjang (mm)'),
                Tables\Columns\TextColumn::make('lebar')->label('Lebar (mm)'),
                Tables\Columns\TextColumn::make('tinggi')->label('Tinggi (mm)'),
                Tables\Columns\TextColumn::make('harga')->label('Harga'),
                Tables\Columns\TextColumn::make('lokasi')->label('lokasi'),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat Pada')->dateTime('d M Y H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('cetakStruk')
                    ->label('Cetak Struk')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->url(fn(Pesanan $record) => route('admin.cetak.struk', ['id' => $record->id_pesanan]))
                    ->openUrlInNewTab(),
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

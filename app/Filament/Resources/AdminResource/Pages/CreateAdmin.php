<?php

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms;

class CreateAdmin extends CreateRecord
{
    protected static string $resource = AdminResource::class;

    protected function getFormSchema(): array
    {
        return [
            // Input untuk nama admin
            Forms\Components\TextInput::make('name')
                ->label('Nama Admin')
                ->required(),
            
            // Input untuk email admin
            Forms\Components\TextInput::make('email')
                ->label('Email Admin')
                ->email()
                ->required(),
            
            // Input password dengan fitur tombol mata untuk melihat password
            Forms\Components\TextInput::make('password')
                ->label('Password')
                ->password() // Menandakan ini adalah input password
                ->required()
        ];
    }
}

<?php

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use Filament\Resources\Pages\EditRecord;

class EditAdmin extends EditRecord
{
    protected static string $resource = AdminResource::class;
        protected function afterSave(): void
    {
        // Redirect ke halaman Admin List setelah update berhasil
        $this->redirect($this->getResource()::getUrl('index'));
    }
}

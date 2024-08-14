<?php

namespace App\Filament\Resources\BillingupdateResource\Pages;

use App\Filament\Resources\BillingupdateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBillingupdate extends EditRecord
{
    protected static string $resource = BillingupdateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

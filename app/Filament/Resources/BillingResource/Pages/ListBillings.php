<?php

namespace App\Filament\Resources\BillingResource\Pages;

use App\Filament\Resources\BillingResource;
use App\Filament\Resources\BillingResource\Widgets\Billingstat;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBillings extends ListRecords
{
    protected static string $resource = BillingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return[
            Billingstat::class
        ];
    }
}

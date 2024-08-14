<?php

namespace App\Filament\Resources\BillingResource\Widgets;
use App\Models\billing;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Billingstat extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Contacted', billing::query()->where('Status', 'Contacted')->count()),
            Stat::make('Not Contacted', billing::query()->where('Status', 'Not Contacted')->count()),
            Stat::make('Voc Call', billing::query()->where('VOC CALL', 'Paid Before Caring')->count()),
            Stat::make('Voc Visit', billing::query()->where('VOC VISIT', 'Paid Before Caring')->count())
        ];
    }
}

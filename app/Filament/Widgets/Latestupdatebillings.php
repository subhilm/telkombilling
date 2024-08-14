<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\BillingupdateResource;
use Brick\Math\BigInteger;
use Doctrine\DBAL\Types\BigIntType;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class Latestupdatebillings extends BaseWidget
{
    protected int | string | array  $columnSpan = 'full';
    protected static ?int $sort =2;
    public function table(Table $table): Table
    {
        return $table
            ->query(BillingupdateResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('updated_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('CCA')
                    ->searchable(),
                Tables\Columns\TextColumn::make('SND')
                    ->searchable(),
                    Tables\Columns\TextColumn::make('SND_GROUP'),
                    Tables\Columns\TextColumn::make('Nama'),
                    Tables\Columns\TextColumn::make('Alamat'),
                    Tables\Columns\TextColumn::make('NCLI'),
                    Tables\Columns\TextColumn::make('DATMS'),
                    Tables\Columns\TextColumn::make('DATRS'),
                    Tables\Columns\TextColumn::make('CUSTOMER'),
                    Tables\Columns\TextColumn::make('NM_CLUSTER'),
                    Tables\Columns\TextColumn::make('PORTOFOLIO'),
                    Tables\Columns\TextColumn::make('PRODUK'),
                    Tables\Columns\TextColumn::make('BUNDLING'),
                    Tables\Columns\TextColumn::make('INDIHOME'),
                    Tables\Columns\TextColumn::make('JENIS_INDIHOME'),
                    Tables\Columns\TextColumn::make('DIVISI'),
                    Tables\Columns\TextColumn::make('WITEL'),
                    Tables\Columns\TextColumn::make('DATEL'),
                    Tables\Columns\TextColumn::make('STO'),
                    Tables\Columns\TextColumn::make('UBIS'),
                    Tables\Columns\TextColumn::make('BISNIS_AREA'),
                    Tables\Columns\TextColumn::make('SEGMEN'),
                    Tables\Columns\TextColumn::make('SUBSEGMEN'),
                    Tables\Columns\TextColumn::make('NPER'),
                    Tables\Columns\TextColumn::make('BILL_AMOUNT'),
                    Tables\Columns\TextColumn::make('RP_TOTAL_NET'),
                    Tables\Columns\TextColumn::make('RP_TOTAL'),
                    Tables\Columns\TextColumn::make('INSTALL ADDRESS'),
                    Tables\Columns\TextColumn::make('CUSTOMER NAME'),
                    Tables\Columns\TextColumn::make('CHANNEL'),
                    Tables\Columns\TextColumn::make('KCONTACT'),
                    Tables\Columns\TextColumn::make('GSM'),
                    Tables\Columns\TextColumn::make('VOC CALL'),
                    Tables\Columns\TextColumn::make('VOC VISIT'),
                    Tables\Columns\TextColumn::make('KETERANGAN'),
                    Tables\Columns\TextColumn::make('STATUS'),
                    Tables\Columns\TextColumn::make('STATUS_BAYAR')
                    ->label('Status Bayar'),
                    Tables\Columns\TextColumn::make('CEK'),
                    Tables\Columns\TextColumn::make('CEK 2 (Digital Produk)'),
            ]);
    }
}

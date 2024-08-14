<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BillingResource\Pages;
use App\Filament\Resources\BillingResource\RelationManagers;
use App\Models\Billing;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Http\Request;

class BillingResource extends Resource
{

    use WithFileUploads;

    protected static ?string $model = Billing::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'SND';

    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('CCA')
                        ->required(),
                Forms\Components\TextInput::make('SND')
                        ->required(),
                Forms\Components\TextInput::make('GSM')
                        ->required(),
                Forms\Components\Select::make('VOC CALL')
                        ->options([
                            'Paid Before Caring' => 'Paid Before Caring',
                            'Contacted | Pindah Rumah/Selesai Kontrak' => 'Contacted | Pindah Rumah/Selesai Kontrak',
                            'Contacted | Kendala Keuangan' => 'Contacted | Kendala Keuangan',
                            'Contacted | Tagihan tidak sesuai/Tarif tidak sesuai janji' => 'Contacted | Tagihan tidak sesuai/Tarif tidak sesuai janji',
                            'Contacted | Gangguan LOS' => 'Contacted | Gangguan LOS',
                            'Contacted | Gangguan Inet Lambat' => 'Contacted | Gangguan Inet Lambat',
                            'Contacted | Gangguan Telepon' => 'Contacted | Gangguan Telepon',
                            'Contacted | Gangguan Useetv' => 'Contacted | Gangguan Useetv',
                            'Contacted | Jarang Dipakai' => 'Contacted | Jarang Dipakai',
                            'Contacted | Pindah Kompetitor' => 'Contacted | Pindah Kompetitor',
                            'Contacted | Minta Diangsur/Cicilan' => 'Contacted | Minta Diangsur/Cicilan',
                            'Contacted | Minta Jemput Tagihan' => 'Contacted | Minta Jemput Tagihan',
                            'Contacted | Janji Bayar' => 'Contacted | Janji Bayar',
                            'Contacted | Sementara Diluar Kota/Daerah' => 'Contacted | Sementara Diluar Kota/Daerah',
                            'Contacted | Ingin Bermohon Cabut/Tutup Sementara' => 'Contacted | Ingin Bermohon Cabut/Tutup Sementara',
                            'Contacted | Proses Rilis Anggaran' => 'Contacted | Proses Rilis Anggaran',
                            'Contacted | Tidak Tahu Tagihan/Tidak Tahu Cara Bayar (Billper)' => 'Contacted | Tidak Tahu Tagihan/Tidak Tahu Cara Bayar (Billper)',
                            'Contacted | Layanan Belum Aktif' => 'Contacted | Layanan Belum Aktif',
                            'Contacted | Tidak Merasa Pasang/PSB' => 'Contacted | Tidak Merasa Pasang/PSB',
                            'Not Contacted | Bukan Pemilik/Bukan DM' => 'Not Contacted | Bukan Pemilik/Bukan DM',
                            'Not Contacted | Salah Sambung' => 'Not Contacted | Salah Sambung',
                            'Not Contacted | Nada Sibuk' => 'Not Contacted | Nada Sibuk',
                            'Not Contacted | RNA' => 'Not Contacted | RNA',
                            'Not Contacted | Tidak Aktif/Diluar Jangkauan' => 'Not Contacted | Tidak Aktif/Diluar Jangkauan',
                            'Not Contacted | Dialihkan/Tidak Terdaftar' => 'Not Contacted | Dialihkan/Tidak Terdaftar',
                            'Not Contacted | Tidak Ada Nomor/Data Tidak Valid' => 'Not Contacted | Tidak Ada Nomor/Data Tidak Valid',
                            'Lunas' => 'Lunas',
                            'Bundling' => 'Bundling',
                            'Eksepsi' => 'Eksepsi',
                            'Belum Bayar Biaya PSB' => 'Belum Bayar Biaya PSB'
                        ])
                        ->label('VOC CALL'),
                Forms\Components\Select::make('VOC VISIT')
                        ->label('VOC VISIT')
                        ->options([
                            'Paid Before Caring' => 'Paid Before Caring',
                            'Contacted | Tidak Merasa Pasang/PSB' => 'Contacted | Tidak Merasa Pasang/PSB',
                            'Contacted | Pindah Rumah/Selesai Kontrak' => 'Contacted | Pindah Rumah/Selesai Kontrak',
                            'Contacted | Kendala Keuangan' => 'Contacted | Kendala Keuangan',
                            'Contacted | Tagihan tidak sesuai/Tarif tidak sesuai janji' => 'Contacted | Tagihan tidak sesuai/Tarif tidak sesuai janji',
                            'Contacted | Gangguan LOS' => 'Contacted | Gangguan LOS',
                            'Contacted | Gangguan Inet Lambat' => 'Contacted | Gangguan Inet Lambat',
                            'Contacted | Gangguan Telepon' => 'Contacted | Gangguan Telepon',
                            'Contacted | Gangguan Useetv' => 'Contacted | Gangguan Useetv',
                            'Contacted | Jarang Dipakai' => 'Contacted | Jarang Dipakai',
                            'Contacted | Pindah Kompetitor' => 'Contacted | Pindah Kompetitor',
                            'Contacted | Minta Diangsur/Cicilan' => 'Contacted | Minta Diangsur/Cicilan',
                            'Contacted | Jemput Tagihan' => 'Contacted | Jemput Tagihan',
                            'Contacted | Sementara Diluar Kota/Daerah' => 'Contacted | Sementara Diluar Kota/Daerah',
                            'Contacted | Ingin Bermohon Cabut/Tutup Sementara' => 'Contacted | Ingin Bermohon Cabut/Tutup Sementara',
                            'Contacted | Proses Rilis Anggaran' => 'Contacted | Proses Rilis Anggaran',
                            'Contacted | Tidak Tahu Tagihan/Tidak Tahu Cara Bayar (Billper)' => 'Contacted | Tidak Tahu Tagihan/Tidak Tahu Cara Bayar (Billper)',
                            'Contacted | Layanan Belum Aktif' => 'Contacted | Layanan Belum Aktif',
                            'Not Contacted | Bukan Pemilik/Bukan DM' => 'Not Contacted | Bukan Pemilik/Bukan DM',
                            'Not Contacted | Alamat Tidak Ditemukan' => 'Not Contacted | Alamat Tidak Ditemukan',
                            'Not Contacted | Rumah Tak Berpenghuni' => 'Not Contacted | Rumah Tak Berpenghuni',
                            'Not Contacted | Tidak Bertemu Penghuni' => 'Not Contacted | Tidak Bertemu Penghuni',
                            'Not Contacted | Bukan Pelanggan Bersangkutan' => 'Not Contacted | Bukan Pelanggan Bersangkutan',
                        ]),

                Forms\Components\Select::make('STATUS')
                    ->options([
                            'Not Contacted' => 'Not Contacted',
                            'Contacted' => 'Contacted',
                            '' => 'Kosong'

                    ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
            ])
            ->filters([
                
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
        

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    BulkAction::make('deleteAll')
                    ->label('Delete All Records')
                    ->action(function () {
                        DB::table('billings')->delete();
                    })
                    ->requiresConfirmation()
                    ->color('danger')
                    ->icon('heroicon-o-trash'),
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
            'index' => Pages\ListBillings::route('/'),
            'create' => Pages\CreateBilling::route('/create'),
            'edit' => Pages\EditBilling::route('/{record}/edit'),
        ];
    }

    
    public function importCsv(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt'
        ]);

        $file = $request->file('file');
        $filePath = $file->storeAs('temp', $file->getClientOriginalName());

        if (($handle = fopen(Storage::path($filePath), 'r')) !== false) {
            fgetcsv($handle, 1000, ',');

            DB::beginTransaction();

            try {
                while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                    DB::table('billings')->updateOrInsert(
                            ['CCA' => $row[0]],
                            ['SND' => $row[1]],
                            ['SND_GROUP' => $row[2]],
                            ['Nama' => $row[3]],
                            ['Alamat' => $row[4]],
                            ['NCLI' => $row[5]],
                            ['DATMS' => $row[6]],
                            ['DATRS' => $row[7]],
                            ['CUSTOMER' => $row[8]],
                            ['NM_CLUSTER' => $row[9]],
                            ['PORTOFOLIO' => $row[10]],
                            ['PRODUK' => $row[11]],
                            [']BUNDLING' => $row[12]],
                            ['INDIHOME' => $row[13]],
                            ['JENIS_INDIHOME' => $row[14]],
                            ['DIVISI' => $row[15]],
                            ['WITEL' => $row[16]],
                            ['DATEL' => $row[17]],
                            ['STO' => $row[18]],
                            ['UBIS' => $row[19]],
                            ['BISNIS_AREA' => $row[20]],
                            ['SEGMEN' => $row[21]],
                            ['SUBSEGMEN' => $row[22]],
                            ['NPER' => $row[23]],
                            ['BILL_AMOUNT' => $row[24]],
                            ['RP_TOTAL_NET' => $row[25]],
                            ['RP_TOTAL' => $row[26]],
                            ['INSTALL ADDRESS' => $row[27]],
                            ['CUSTOMER_NAME' => $row[28]],
                           ['CHANNEL' => $row[29]],
                            ['KCONTACT' => $row[30]],
                            ['GSM' => $row[31]],
                            ['VOC CALL' => $row[32]],
                            ['VOC VISIT' => $row[33]],
                            ['KETERANGAN' => $row[34]],
                            ['STATUS' => $row[35]],
                            ['STATUS_BAYAR' => $row[36]],
                            ['CEK' => $row[37]],
                            ['CEK 2 (Digital Produk)' => $row[38]],
                        
                    );
                }

                fclose($handle);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }
        }

        Storage::delete($filePath);

        return redirect()->route('billings.index')->with('success', 'CSV imported successfully!');
    }
}
    

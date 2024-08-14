<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ImportCsv extends Component
{
    use WithFileUploads;

    public $file;

    public function importCsv()
    {
        $this->validate([
            'file' => 'required|file|mimes:csv,txt'
        ]);

        $filePath = $this->file->storeAs('temp', $this->file->getClientOriginalName());

        if (($handle = fopen(Storage::path($filePath), 'r')) !== false) {
            fgetcsv($handle, 1000, ','); // Skip header row

            DB::beginTransaction();

            try {
                while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                    // Log row data for debugging
                    \Log::info('CSV Row:', $row);

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
                \Log::error('CSV Import Error:', ['error' => $e->getMessage()]);
                throw $e;
            }
        } else {
            \Log::error('Failed to open CSV file');
        }

        Storage::delete($filePath);

        session()->flash('success', 'CSV imported successfully!');
    }

    public function render()
    {
        return view('livewire.import-csv');
    }
}

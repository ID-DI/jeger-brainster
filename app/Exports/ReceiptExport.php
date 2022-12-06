<?php

namespace App\Exports;

use App\Models\Receipt;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReceiptExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('receipts')
        ->leftJoin('files', 'receipts.file_id', '=', 'files.id')
        ->get();
       
    }
}

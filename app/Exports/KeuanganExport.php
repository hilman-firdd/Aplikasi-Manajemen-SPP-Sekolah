<?php

namespace App\Exports;

use App\Models\Keuangan;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class KeuanganExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Keuangan::all();
    }

    public function view(): View
    {
        return view('admin.keuangan.export', [
            'keuangan' => $this->collection()
        ]);
    }
}

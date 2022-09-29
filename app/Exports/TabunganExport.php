<?php

namespace App\Exports;

use App\Models\Tabungan;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class TabunganExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Tabungan::all();
    }

    public function view(): View
    {
        return view('admin.tabungan.export', [
            'tabungan' => $this->collection()
        ]);
    }
}

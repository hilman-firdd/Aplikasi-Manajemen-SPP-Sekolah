<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class SppExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Transaksi::orderBy('created_at','desc')->get();
    }

    public function view(): View
    {
        return view('admin.transaksi.transaksiexport', [
            'transaksi' => $this->collection(),
        ]);
    }
}

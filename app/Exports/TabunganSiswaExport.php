<?php

namespace App\Exports;

use App\Models\Tabungan;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class TabunganSiswaExport implements FromView
{
    public function __construct($siswa)
    {
        $this->id = $siswa->id;
        $this->siswa = $siswa;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Tabungan::where('siswa_id', $this->id)->get();
    }

    public function view(): View
    {
        return view('admin.siswa.tabunganexport', [
            'tabungan' => $this->collection(),
            'siswa' => $this->siswa
        ]);
    }
}

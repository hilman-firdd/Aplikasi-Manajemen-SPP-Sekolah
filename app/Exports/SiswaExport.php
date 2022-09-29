<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class SiswaExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Siswa::with('kelas')->get();
    }

    public function view(): View
    {
        return view('admin.siswa.export', [
            'siswa' => $this->collection()
        ]);
    }
}

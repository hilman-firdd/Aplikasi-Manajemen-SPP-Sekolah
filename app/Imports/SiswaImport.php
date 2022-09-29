<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $index => $row)
        {
            if($index != 0 && ($row[0] != '') && ($row[1] != '')){
                Siswa::create([
                    'kelas_id' => Kelas::firstOrCreate(['nama' => $row[0]])->id,
                    'nama' => $row[1],
                    'tempat_lahir' => $row[2],
                    'tanggal_lahir' => $row[3],
                    'jenis_kelamin' => $row[4],
                    'alamat' => $row[5],
                    'nama_wali' => $row[6],
                    'telp_wali'=> $row[7],
                    'pekerjaan_wali' => $row[8],
                    'is_yatim' => (($row[9] == 'Yatim') ? '1' : '0'),
                ]);
            }
        }
    }
}

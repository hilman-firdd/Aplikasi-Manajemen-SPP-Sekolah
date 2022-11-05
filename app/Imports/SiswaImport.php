<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            if ($index != 0 && ($row[0] != '') && ($row[1] != '')) {
                $siswa = Siswa::create([
                    'kelas_id' => Kelas::firstOrCreate(['nama' => $row[0]])->id,
                    'nama' => $row[1],
                    'email' => $row[2],
                    'nik' => $row[3],
                    'tempat_lahir' => $row[4],
                    'tanggal_lahir' => $row[5],
                    'jenis_kelamin' => $row[6],
                    'alamat' => $row[7],
                    'nama_wali' => $row[8],
                    'telp_wali' => $row[9],
                    'pekerjaan_wali' => $row[10],
                    'is_yatim' => (($row[11] == 'Yatim') ? '1' : '0'),
                ]);
                $user = User::create([
                    'name' => $row[1],
                    'username' => strtolower(str_replace(' ', '', ($row[1]))),
                    'email' => $row[2],
                    'nik' => $row[3],
                    'password' => Hash::make($row[3])
                ]);

                $siswa['id'] = $user->id;
                $user_id = $user->id;
                $siswa->save();
                $role_id = 5;
                $user_type = 'App\Models\User';

                DB::table('role_user')->insert(
                    array(
                        'role_id' => $role_id,
                        'user_id' => $user_id,
                        'user_type' => $user_type
                    )
                );
            }
        }
    }
}

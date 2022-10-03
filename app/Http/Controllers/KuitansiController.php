<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kuitansi;
use Illuminate\Http\Request;

class KuitansiController extends Controller
{
    public function index()
    {
        $user = User::all();
        $kuitansi = Kuitansi::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.kuitansi.index', [
            'kuitansi' => $kuitansi,
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $semua = [];
        $data = $request->data;
        $lastnum = 1;
        foreach ($data as $dat) {
            if (!isset($semua[$dat['num']])) {
                $semua[$dat['num']] = ['nama' => $dat['value']];
            }
            if ($dat['num'] == $lastnum) { //1, 1,
                array_push($semua[$dat['num']], $dat['key'], $dat['value']);
            }
            $lastnum = $dat['num'];
        }
        foreach ($semua as $index => $sem) {
            if (count($sem) <= 2) {
                unset($semua[$index]);
            }
        }

        if ($request->total != 0) {
            $kuitansi = Kuitansi::create([
                'invoice' => $request->invoice,
                'items' => json_encode($semua),
                'total' => $request->total
            ]);
            if ($kuitansi) {
                $pesan = 'success';
            } else {
                $pesan = 'fail';
            }
        } else {
            $pesan = 'fail';
        }

        return response()->json(['msg' => $pesan]);
    }

    public function print(Kuitansi $kuitansi)
    {
        $items = json_decode($kuitansi->items);
        return view('admin.kuitansi.print', ['kuitansi' => $kuitansi, 'items' => $items]);
    }
}

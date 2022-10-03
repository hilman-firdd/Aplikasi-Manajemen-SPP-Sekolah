<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="Aplikasi SPP Dashboard Page" />
    <meta name="keywords" content="HTML, CSS, JavaScript, Bootstrap, Chart JS" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Hilman Firdaus" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <title>Aplikasi SPP - Dashboard</title>
</head>

<body>
    <div class="page-header" style="position: relative">
        <h1 class="page-title">
            Kuitansi
        </h1>
        <div>
            <?php
            $arrContextOptions=array(
                "ssl"=>array(
                    "verify_peer"=>false,
                    "verify_peer_name"=>false,
                ),
            );
            $path = asset('storage/logo').'/'.str_replace('public/logo/','', $pengaturan->logo);
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path,false,stream_context_create($arrContextOptions));
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            ?>
            <img src="<?php echo $base64?>" width="70" height="70" style="position: absolute; top:0; right:0;" />
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card" id="print">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h2>{{ $sitename }}</h2>
                            <p>
                                Pembayaran Biaya SPP<br>
                                Invoice: <span id="invoice">01/SPP/{{ now()->format('YmdHis') }}</span>
                            </p>
                        </div>
                        <div class="col-3">
                            <div class="d-flex">
                                <p class="ml-auto">
                                    Tanggal : {{ now()->format('d-m-Y') }}<br>
                                    Nama : {{ Auth::user()->name }}
                                </p>
                            </div>
                        </div>
                        <hr class="bg-color">
                        <table class="table card-table table-hover table-vcenter text-wrap title" id="print">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama Siswa</th>
                                    <th>Nama Tagihan</th>
                                    <th>Diskon</th>
                                    <th>Dibayarkan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                <tr>
                                    <td><input type="text" class="form-control"
                                            value="{{ $item->created_at->format('d-m-Y') }}"></td>
                                    <td><input type="text" class="form-control" id="jumlah-0"
                                            value="{{ $item->siswa->nama }}"></td>
                                    <td><input type="text" class="form-control" data-id="0"
                                            value="{{ ($item->tagihan->nama) }}"></td>
                                    <td><input type="text" class="form-control" data-id="0"
                                            value="IDR. {{ format_idr($item->diskon) }}"></td>
                                    <td><input type="text" class="form-control" data-id="0"
                                            value="IDR. {{ format_idr($item->keuangan->jumlah) }}"></td>
                                </tr>
                                @endforeach
                                <tr id="newrow"></tr>
                            </tbody>
                        </table>
                        <div class="btn btn-outline-primary col-12 btn-sm" title="tambah baris" id="tambah">
                            <span class="fe fe-plus"></span>
                        </div>
                        <table class="table card-table table-vcenter text-wrap title">
                            <tr>
                                <td style="width: 60%"></td>
                                <td style="width: 20%;text-align: right;"><b>TOTAL</b></td>
                                <td style="width: 20%;">IDR. <span id="total">{{ $total }}</span></td>
                            </tr>
                            <tr>
                                <td style="width: 60%"></td>
                                <td style="width: 20%;text-align: left;">
                                    <b>Tanda Terima</b>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <p>....................</p>
                                </td>
                                <td style="width: 20%;text-align: left;">
                                    <b>Hormat Kami</b>
                                    <br>
                                    <br>
                                    <div style="position: relative">
                                        <?php
                                                $arrContextOptions=array(
                                                    "ssl"=>array(
                                                        "verify_peer"=>false,
                                                        "verify_peer_name"=>false,
                                                    ),
                                                );
                                                $path = asset('ttd.png');
                                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                                $data = file_get_contents($path,false,stream_context_create($arrContextOptions));
                                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                                ?>
                                        <img src="<?php echo $base64?>" width="70" height="70"
                                            style="position: absolute; top:-20px; right:60px; z-index:-999;" />
                                    </div>
                                    <br>
                                    <br>
                                    <p>{{ $name }}</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
</script>
</body>

</html>
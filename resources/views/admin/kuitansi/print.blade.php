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
    <div class="page-header">
        <h1 class="page-title">
            Kuitansi
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card" id="print">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h2>{{ $sitename }}</h2>
                            <p>Invoice: <span id="invoice">{{ $kuitansi->invoice }}</span></p>
                        </div>
                        <div class="col-3">
                            <div class="d-flex">
                                <p class="ml-auto">
                                    Tanggal : {{ $kuitansi->created_at->format('d-m-Y') }}<br>
                                    Nama : {{ Auth::user()->name }}
                                </p>
                            </div>
                        </div>
                        <hr class="bg-color">
                        <table class="table card-table table-hover table-vcenter text-wrap title" id="print">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                <tr>
                                    <td style="width: 60%">
                                        <input type="text" class="form-control" value="{{ $item->nama }}">
                                    </td>
                                    <td><input type="text" class="form-control" id="jumlah-0"
                                            value="{{ $item->jumlah }}"></td>
                                    <td><input type="text" class="form-control harga" data-id="0"
                                            value="{{ $item->harga }}"></td>
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
                                <td style="width: 20%;">IDR. <span id="total">{{ $kuitansi->total }}</span></td>
                            </tr>
                            <tr>
                                <td style="width: 60%"></td>
                                <td style="width: 20%;text-align: left;">
                                    <b>Tanda Terima</b>
                                    <br>
                                    <br>
                                    <p>............................</p>
                                </td>
                                <td style="width: 20%;text-align: left;">
                                    <b>Hormat Kami</b>
                                    <br>
                                    <br>
                                    <p>............................</p>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary ml-auto" id="cetak">Cetak</button>
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
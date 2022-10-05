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
        <div style="position: relative">
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
                            <h2 style="text-align:center"><b> <?php echo e($sitename); ?> </b></h2>
                            <h3 style="text-align:center">Laporan Keuangan</h3>
                        </div>
                        <div class="col-3">
                            <div class="d-flex">
                                <p class="ml-auto">
                                    Tanggal : <?php echo e($tgl_awal); ?> s/d <?php echo e($tgl_akhir); ?><br>
                                    Nama : <?php echo e(Auth::user()->name); ?>

                                </p>
                            </div>
                        </div>
                        <hr class="bg-color">
                        <table style="border: 1px solid black; width: 100%; padding:5px;">
                            <tr style="border: 1px solid black;">
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>Total Kas</th>
                            </tr>
                            <?php $__currentLoopData = $cetak; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="<?php echo e(($index%2) ? 'gray' : ''); ?>">
                                <td style="min-width:30px;text-align: left;">
                                    <?php echo e($index+1); ?>

                                </td>
                                <td style="min-width:100px;text-align: left;">
                                    <?php echo e($item->created_at->format('d-m-Y')); ?>

                                </td>
                                <td style="min-width:230px;text-align: left;">
                                    <?php echo e($item->keterangan); ?>

                                </td>
                                <td style="min-width:90px;text-align: left;">
                                    Rp. <?php echo e(format_idr($item->jumlah)); ?>

                                </td>
                                <td style="min-width:80px;text-align: left;">
                                    <?php echo e($item->total_kas); ?>

                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                        <div class="btn btn-outline-primary col-12 btn-sm" title="tambah baris" id="tambah">
                            <span class="fe fe-plus"></span>
                        </div>
                        <table class="table card-table table-vcenter text-wrap title">
                            <br>
                            <br>
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
                                    <p><?php echo e($name); ?></p>
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

</html><?php /**PATH C:\laragon\www\spp-app\resources\views/admin/laporan/laporankeuangan.blade.php ENDPATH**/ ?>
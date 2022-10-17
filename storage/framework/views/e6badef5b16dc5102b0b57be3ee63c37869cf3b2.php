
<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<section class="p-5">
    <header>
      <div class="d-flex align-items-center">
        <h3>Selamat Datang, </h3>  <?php if (app('laratrust')->hasRole('superadmin|admin|kepsek|bendahara|siswa')) : ?> <h5> Hai.. <?php echo e(Auth::user()->name); ?></h5> <?php endif; // app('laratrust')->hasRole ?>
      </div>
      <p>Dashboard</p>
    </header>
    <div class="information d-flex flex-column gap-5">
      <div class="row mb-2 gap-5">
        <?php if (app('laratrust')->hasRole('superadmin|admin|bendahara|kepsek')) : ?>
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6>Rp. <?php echo e(format_idr($total_uang)); ?></h6>
          <p class="fs-6" style="font-size: 14px!important;">Total Uang</p>
        </div>
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6>Rp. <?php echo e(format_idr($total_uang_masuk)); ?></h6>
          <p class="fs-6" style="font-size: 14px!important;">Total Uang Masuk</p>
        </div>
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6>Rp. <?php echo e(format_idr($total_uang_keluar)); ?></h6>
          <p class="fs-6" style="font-size: 14px!important;">Total Uang Keluar</p>
        </div>
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6>Rp. <?php echo e(format_idr($total_uang_spp)); ?></h6>
          <p class="fs-6" style="font-size: 14px!important;">Total Uang SPP</p>
        </div>
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6>Rp. <?php echo e(format_idr($total_uang_tabungan)); ?></h6>
          <p class="fs-6" style="font-size: 12px!important;">Total Uang Tabungan</p>
        </div>
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6><?php echo e($siswa); ?></h6>
          <p class="fs-6" style="font-size: 14px!important;">Total Siswa</p>
        </div>
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6><?php echo e($kelas); ?></h6>
          <p class="fs-6" style="font-size: 14px!important;">Total Kelas</p>
        </div>
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6><?php echo e($item); ?></h6>
          <p class="fs-6" style="font-size: 14px!important;">Item Tagihan</p>
        </div>
        <?php endif; // app('laratrust')->hasRole ?>
        <?php if (app('laratrust')->hasRole('siswa')) : ?>
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6>
            <?php echo e($total_uang_tabungan_siswa ? format_idr($total_uang_tabungan_siswa[0]["jumlah"]) : '0'); ?>

          </h6>
          <p class="fs-6" style="font-size: 14px!important;">Tagihan</p>
        </div>
        <div class="col-xl-4 col-12 card debit justify-content-center align-items-center">
          <h6><?php echo e($item); ?></h6>
          <p class="fs-6" style="font-size: 14px!important;">Tabungan</p>
        </div>
        <?php endif; // app('laratrust')->hasRole ?>
      </div>
    </div>
    <?php if (app('laratrust')->hasRole('superadmin|admin|bendahara')) : ?>
    <div class="row d-flex mt-4">
      <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title fs-6">Laporan Harian : <?php echo e(now()->format('d-m-Y')); ?></h3>
                <div class="card-options d-flex gap-2">
                    <input class="form-control mr-2" type="text" name="dates" style="max-width: 200px" data-toggle="datepicker" value="" autocomplete="off" id="date">
                    <button id="btn-cetak-spp" class="btn btn-primary btn-sm mr-1" value="#">Cetak</button>
                    <button id="btn-export-spp" class="btn btn-primary btn-sm">Export</button>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table card-table table-hover table-center text-nowrap title" id="print">
                    <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Pembayaran</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                              <td><?php echo e($item->created_at->format('d-m-Y')); ?></td>
                              <td><?php echo e($item->siswa->nama); ?></td>
                              <td><?php echo e($item->tagihan->nama); ?></td>
                              <td>IDR. <?php echo e(format_idr($item->keuangan->jumlah)); ?></td>
                              <?php
                                  $jumlah += $item->keuangan->jumlah
                              ?>
                          </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                              <td><b>Total</b></td>
                              <td></td>
                              <td></td>
                              <td>IDR. <?php echo e(format_idr($jumlah)); ?></td>
                          </tr>
                      </tbody>
                </table>
                </div>
            </div>
      </div>
    </div>
    <?php endif; // app('laratrust')->hasRole ?>
    <?php if (app('laratrust')->hasRole('siswa')) : ?>
    <div class="row d-flex mt-4">
      <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title fs-6">Laporan Harian : <?php echo e(now()->format('d-m-Y')); ?></h3>
                <div class="card-options d-flex gap-2">
                    <input class="form-control mr-2" type="text" name="dates" style="max-width: 200px" data-toggle="datepicker" value="" autocomplete="off" id="date">
                    <button id="btn-cetak-spp" class="btn btn-primary btn-sm mr-1" value="#">Cetak</button>
                    <button id="btn-export-spp" class="btn btn-primary btn-sm">Export</button>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table card-table table-hover table-center text-nowrap title" id="print">
                    <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Pembayaran</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                              <td><?php echo e($item->created_at->format('d-m-Y')); ?></td>
                              <td><?php echo e($item->siswa->nama); ?></td>
                              <td><?php echo e($item->tagihan->nama); ?></td>
                              <td>IDR. <?php echo e(format_idr($item->keuangan->jumlah)); ?></td>
                              <?php
                                  $jumlah += $item->keuangan->jumlah
                              ?>
                          </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                              <td><b>Total</b></td>
                              <td></td>
                              <td></td>
                              <td>IDR. <?php echo e(format_idr($jumlah)); ?></td>
                          </tr>
                      </tbody>
                </table>
                </div>
            </div>
      </div>
    </div>
    <?php endif; // app('laratrust')->hasRole ?>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
  $(document).ready(function () {
      $('[data-toggle="datepicker"]').datepicker({
        format:'mm/dd/yyyy',
      }).datepicker("setDate",'now');

      $('#btn-cetak-spp').on('click', function(){
          var form = document.createElement("form");
          form.setAttribute("style", "display: none");
          form.setAttribute("method", "post");
          form.setAttribute("action", "<?php echo e(route('laporan-harian.cetak')); ?>");
          form.setAttribute("target", "_blank");
          
          var token = document.createElement("input");
          token.setAttribute("name", "_token");
          token.setAttribute("value", "<?php echo e(csrf_token()); ?>");
          
          var dateForm = document.createElement("input");
          dateForm.setAttribute("name", "date");
          dateForm.setAttribute("value", $('#date').val());

          form.appendChild(token);
          form.appendChild(dateForm);
          document.body.appendChild(form);
          form.submit();
      })
      $('#btn-export-spp').on('click', function(){
          var form = document.createElement("form");
          form.setAttribute("style", "display: none");
          form.setAttribute("method", "post");
          form.setAttribute("action", "<?php echo e(route('laporan-harian.export')); ?>");
          form.setAttribute("target", "_blank");
          
          var token = document.createElement("input");
          token.setAttribute("name", "_token");
          token.setAttribute("value", "<?php echo e(csrf_token()); ?>");
          
          var dateForm = document.createElement("input");
          dateForm.setAttribute("name", "date");
          dateForm.setAttribute("value", $('#date').val());

          form.appendChild(token);
          form.appendChild(dateForm);
          document.body.appendChild(form);
          form.submit();
      })
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\spp-app\resources\views/dashboard.blade.php ENDPATH**/ ?>
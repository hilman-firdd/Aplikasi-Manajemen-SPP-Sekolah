

<?php $__env->startSection('page-name', 'Siswa'); ?>


<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?php echo $__env->yieldContent('page-name'); ?></h5>
            </div>
            <div class="card-body">
                <p><b>Kelas</b> : <?php echo e($siswa->kelas->nama); ?></p>
                <p>
                    <b>Nama</b> : <?php echo e($siswa->nama); ?>

                    <?php if($siswa->is_yatim): ?>
                    <span class="tag tag-green">Yatim</span>
                    <?php endif; ?>
                </p>
                <p><b>NIK</b> : <?php echo e($siswa->nik); ?></p>
                <p><b>Email</b> : <?php echo e($siswa->email); ?></p>
                <p><b>Tempat, Tanggal Lahir</b> : <?php echo e($siswa->tempat_lahir.', '. $siswa->tanggal_lahir); ?></p>
                <p><b>Alamat</b> : <?php echo e($siswa->alamat); ?></p>
                <p><b>Nama Wali</b> : <?php echo e($siswa->nama_wali); ?></p>
                <p><b>No. Telp</b> : <?php echo e($siswa->telp_wali); ?></p>
                <p><b>Pekerjaan Wali</b> : <?php echo e($siswa->pekerjaan_wali); ?></p>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-6 mt-3">
        <div class="card">
            <div class="card-header">
                <?php if($saldo != '0'): ?>
                <div class="card-options d-flex justify-content-between">
                    <h5 class="card-title">Tabungan</h5>
                    <div>
                        <a href="<?php echo e(route('tabungan.cetak', $siswa->id)); ?>" target="_blank"
                            class="btn btn-primary mr-1">Cetak</a>
                        <a href="<?php echo e(route('tabungan.siswa.export', $siswa->id)); ?>" target="_blank"
                            class="btn btn-primary">Export</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <p><b>Saldo : </b> IDR. <?php echo e($saldo); ?></p>
                <table class="table card-table table-hover table-vcenter text-wrap">
                    <tr>
                        <th>Tanggal</th>
                        <th>KD</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                    <?php $__currentLoopData = $tabungan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->created_at->format('d-m-Y')); ?></td>
                        <td>
                            <?php if($item->tipe == 'in'): ?>
                            Menabung
                            <?php elseif($item->tipe == 'out'): ?>
                            Penarikan
                            <?php endif; ?>
                        </td>
                        <td style="min-width: 100px">IDR. <?php echo e(format_idr($item->jumlah)); ?></td>
                        <td style="max-width: 100px"><?php echo e($item->keperluan); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
                <div class="card-footer">
                    <div class="d-flex">
                        <div class="ml-auto mb-0">
                            <?php echo e($tabungan->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-6 mt-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Tagihan SPP</h5>
                <?php if(!$siswa->is_yatim): ?>
                <div class="card-options d-flex justify-content-between">
                    <div>
                        <input class="form-control" type="text" name="dates" style="max-width: 300px" id="daterange"
                            value="<?php echo e(now()->subDay(7)->format('m-d-Y')." - ".now()->format('m-d-Y')); ?>">
                    </div>
                    <div>
                        <button id="btn-cetak-spp" class="btn btn-primary mr-1" value="<?php echo e($siswa->id); ?>">Cetak</button>
                        <button id="btn-export-spp" class="btn btn-primary" value="<?php echo e($siswa->id); ?>">Export</button>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php if($siswa->is_yatim): ?>
                <b>Siswa/i Yatim biaya gratis</b>
                <?php else: ?>
                <table class="table card-table table-hover table-vcenter text-wrap">
                    <tr>
                        <th>Nama Tagihan</th>
                        <th>Total</th>
                        <th>Lunas</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                    </tr>
                    <?php $__currentLoopData = $tagihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item['nama']); ?></td>
                        <td><?php echo e($item['total']); ?></td>
                        <td>
                            <?php if($item['is_lunas']): ?>
                            <span class="tag tag-green">Lunas</span>
                            <?php else: ?>
                            <span class="tag tag-purple">Belum</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($item['created_at']); ?></td>
                        <td><?php echo e($item['keterangan']); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(document).ready(function () {
        $('input[name="dates"]').daterangepicker();
    });

    $('#btn-cetak-spp').on('click', function() {
        //form print
        var form = document.createElement('form');
        form.setAttribute('style', 'display:none');
        form.setAttribute('method', 'post');
        form.setAttribute('action', "<?php echo e(route('spp.print')); ?>/" + this.value);
        form.setAttribute('target', '_blank');

        var token = document.createElement('input');
        token.setAttribute('name', '_token');
        token.setAttribute('value', "<?php echo e(csrf_token()); ?>")

        var dateForm = document.createElement('input');
        dateForm.setAttribute('name', 'dates');
        dateForm.setAttribute('value', $('#daterange').val());

        form.appendChild(token)
        form.appendChild(dateForm)
        document.body.appendChild(form)
        form.submit();
    });

    $('#btn-export-spp').on('click', function(){
        //form print
        var form = document.createElement("form");
        form.setAttribute("style", "display: none");
        form.setAttribute("method", "post");
        form.setAttribute("action", "<?php echo e(route('spp.export')); ?>/" + this.value);
        form.setAttribute("target", "_blank");
        
        var token = document.createElement("input");
        token.setAttribute("name", "_token");
        token.setAttribute("value", "<?php echo e(csrf_token()); ?>");
        
        var dateForm = document.createElement("input");
        dateForm.setAttribute("name", "dates");
        dateForm.setAttribute("value", $('#daterange').val());

        form.appendChild(token);
        form.appendChild(dateForm);
        document.body.appendChild(form);
        form.submit();

        console.log($('#daterange').val())
    })
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\spp-app\resources\views/admin/siswa/show.blade.php ENDPATH**/ ?>
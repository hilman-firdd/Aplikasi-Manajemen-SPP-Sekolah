

<?php $__env->startSection('page-name','Keuangan'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1 class="page-title">
        <?php echo $__env->yieldContent('page-name'); ?>
    </h1>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data Keuangan</h5>
            </div>
            <?php if(session()->has('msg')): ?>
            <div class="card-alert alert alert-<?php echo e(session()->get('type')); ?>" id="message"
                style="border-radius: 0px !important">
                <?php if(session()->get('type') == 'success'): ?>
                <i class="fe fe-check mr-2" aria-hidden="true"></i>
                <?php else: ?>
                <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i>
                <?php endif; ?>
                <?php echo e(session()->get('msg')); ?>

            </div>
            <?php endif; ?>
            <div class="card-body">
                <form action="<?php echo e(route('keuangan.store')); ?>" method="post">
                    <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($error); ?><br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-12">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label class="form-label">Keperluan</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="keperluan" value="in" class="selectgroup-input">
                                        <span class="selectgroup-button">Catat Pemasukan</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="keperluan" value="out" class="selectgroup-input">
                                        <span class="selectgroup-button">Catat Pengeluaran</span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group mb-2" style="display:none" id="form-jumlah">
                                <label class="form-label">Jumlah Uang</label>
                                <input type="text" name="jumlah" id="jumlah" class="form-control" min='100' required>
                            </div>
                            <div class="form-group" style="display:none" id="form-keterangan">
                                <label class="form-label">Keterangan</label>
                                <textarea name="keterangan" id="keterangan" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex mt-2">
                        <button id="submit" class="btn btn-primary ml-auto" style="display:none">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-options d-flex justify-content-between">
                    <h5 class="card-title">Mutasi Keuangan</h5>
                    <a href="<?php echo e(route('keuangan.export')); ?>" class="btn btn-primary btn-sm ml-2"
                        download="true">Export</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-hover table-vcenter text-wrap">
                    <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Tanggal</th>
                            <th>KD</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                            <th>Total Kas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $keuangan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><span class="text-muted"><?php echo e((($index+1) + ($keuangan->currentPage() * $keuangan->perPage()) - $keuangan->perPage())); ?></span></td>
                            <td><?php echo e($item->created_at->format('d-m-Y')); ?></td>
                            <td>
                                <?php if($item->tipe == 'in'): ?>
                                Uang Masuk
                                <?php elseif($item->tipe == 'out'): ?>
                                Uang Keluar
                                <?php endif; ?>
                            </td>
                            <td style="max-width:150px;"><?php echo e($item->keterangan); ?></td>
                            <td>IDR. <?php echo e(format_idr($item->jumlah)); ?></td>
                            <td>IDR. <?php echo e(format_idr($item->total_kas)); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <div class="ml-auto mb-0">
                        <?php echo e($keuangan->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<script>
    $(document).ready(function () {
        var keperluan = 'in';
        //keperluan
        $('.selectgroup-input').change(function(){
            keperluan = this.value
            $('#form-jumlah').show()
            $('#form-keterangan').show()
            $('#submit').show()
        })

    });

    var jumlah = document.getElementById("jumlah");
        jumlah.addEventListener("keyup", function(e) {
        jumlah.value = convertRupiah(this.value, "Rp. ");
        });
        jumlah.addEventListener('keydown', function(event) {
            return isNumberKey(event);
        });

        function convertRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split  = number_string.split(","),
            sisa   = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }
        
            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
        }
        
        function isNumberKey(evt) {
            key = evt.which || evt.keyCode;
            if ( 	key != 188 // Comma
                && key != 8 // Backspace
                && key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
                && (key < 48 || key > 57) // Non digit
                ) 
            {
                evt.preventDefault();
                return;
            }
        }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\spp-app\resources\views/admin/keuangan/index.blade.php ENDPATH**/ ?>
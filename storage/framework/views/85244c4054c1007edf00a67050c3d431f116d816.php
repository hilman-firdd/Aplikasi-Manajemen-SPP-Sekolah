

<?php $__env->startSection('site-name','Sistem Informasi SPP'); ?>
<?php $__env->startSection('page-name', (isset($tagihan) ? 'Ubah Tagihan' : 'Tagihan Baru')); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/component-custom-switch.min.css')); ?>">
<link href="<?php echo e(asset('template/assets/plugins/select2/select2.min.css')); ?>" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: black;
    }

    .select2 {
        width: 100% !important;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-8">
        <form action="<?php echo e((isset($tagihan) ? route('tagihan.update', $tagihan->id) : route('tagihan.create'))); ?>"
            method="post" class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $__env->yieldContent('page-name'); ?></h3>
            </div>
            <div class="card-body">
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
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama"
                                value="<?php echo e(isset($tagihan) ? $tagihan->nama : old('nama')); ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jumlah</label>
                            <input type="text" class="form-control" name="jumlah"
                                value="<?php echo e(isset($tagihan) ? "Rp. ". number_format($tagihan->jumlah, 0, ',', '.') : old('jumlah')); ?>" id="jumlah" required>
                        </div>
                        <div class="form-group">
                            <div class="form-label">Peserta</div>

                            <div class="custom-switch custom-switch-label-onoff d-flex align-items-center">
                                <input type="checkbox" id="check" name="peserta" value="1" class="custom-switch-input"
                                    <?php echo e(isset($tagihan) ? ($tagihan->wajib_semua == 1 ? 'checked' : '') : 'checked'); ?> >
                                <label class="custom-switch-btn" for="check"></label>
                                <p class="mt-3 ms-2">Wajib Semua Siswa</p>
                            </div>
                            <div class="custom-switch custom-switch-label-onoff d-flex align-items-center">
                                <input type="checkbox" id="check1" name="peserta" value="2" class="custom-switch-input"
                                    <?php echo e(isset($tagihan) ? (($tagihan->kelas_id != null) ? 'checked' : '') : ''); ?>>
                                <label class="custom-switch-btn" for="check1"></label>
                                <p class="mt-3 ms-2">Hanya Kelas</p>
                            </div>
                            <div class="custom-switch custom-switch-label-onoff d-flex align-items-center">
                                <input type="checkbox" id="check2" name="peserta" value="3" class="custom-switch-input"
                                    <?php echo e(isset($tagihan) ? (($tagihan->kelas_id == null && $tagihan->wajib_semua == null)
                                ? 'checked' : '') : ''); ?>>
                                <label class="custom-switch-btn" for="check2"></label>
                                <p class="mt-3 ms-2">Hanya Siswa</p>
                            </div>
                        </div>
                        <div class="form-group"
                            style="display: <?php echo e(isset($tagihan) ? (($tagihan->kelas_id != null) ? 'block' : 'none') : 'none'); ?>"
                            id="form-kelas">
                            <label class="form-label">Kelas</label>
                            <select class="form-control" name="kelas_id" id="hanya-kelas">
                                <?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>" <?php echo e(isset($tagihan) ? (($tagihan->kelas_id == $item->id)
                                    ? 'selected' : '') : ''); ?>>
                                    <?php echo e($item->nama); ?> - <?php echo e(isset($item->periode) ? $item->periode->nama : ''); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group"
                            style="display: <?php echo e(isset($tagihan) ? (($tagihan->kelas_id == null && $tagihan->wajib_semua == null) ? 'block' : 'none') : 'none'); ?>"
                            id="form-siswa">
                            <label class="form-label">Siswa</label>
                            <select class="form-control" name="siswa_id[]" id="hanya-siswa" multiple>
                                <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>" <?php echo e(isset($tagihan) ? (($tagihan->wajib_semua == null &&
                                    $tagihan->kelas_id == null) ? (in_array($item->id,
                                    $tagihan->siswa->pluck('id')->toArray()) ? 'selected' : '') : '') : ''); ?>>
                                    <?php echo e($item->nik.'-'.$item->nama); ?>-<?php echo e($item->kelas->nama); ?> <?php echo e(isset($item->kelas->periode) ? "(". $item->kelas->periode->nama .")" : ''); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <div class="d-flex">
                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger">Batal</a>
                    <button type="submit" class="btn btn-primary ms-2">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('template/assets/plugins/select2/select2.min.js')); ?>"></script>

<script>
    // $(document).ready(function () {
        //     $('#select-beast').selectize({});
        // });
        $('#hanya-kelas').select2({
            placeholder: "Pilih Kelas",
        });
        $('#hanya-siswa').select2({
            placeholder: "Pilih Siswa",
        });

        $('.custom-switch-input').change(function(){
            console.log(this)
            if(this.value == 2){
                $('#check').prop('checked', false);
                $('#check2').prop('checked', false);
                $('#form-kelas').show()
                $('#form-siswa').hide()
                
                $('#hanya-kelas').prop('required', true)
                $('#hanya-siswa').prop('required', false)
            }else if(this.value == 3){
                $('#check1').prop('checked', false);
                $('#check').prop('checked', false);
                $('#form-kelas').hide()
                $('#form-siswa').show()
                
                $('#hanya-kelas').prop('required', false)
                $('#hanya-siswa').prop('required', true)
            }else{
                $('#check1').prop('checked', false);
                $('#check2').prop('checked', false);
                $('#form-kelas').hide()
                $('#form-siswa').hide()

                $('#hanya-kelas').prop('required', false)
                $('#hanya-siswa').prop('required', false)
            }
        })

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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\spp-app\resources\views/admin/tagihan/form.blade.php ENDPATH**/ ?>
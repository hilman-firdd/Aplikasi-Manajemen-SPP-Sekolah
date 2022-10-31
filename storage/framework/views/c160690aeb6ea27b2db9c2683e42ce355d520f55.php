

<?php $__env->startSection('site-name','Sistem Informasi SPP'); ?>
<?php $__env->startSection('page-name', (isset($siswa) ? 'Ubah siswa' : 'siswa Baru')); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/component-custom-switch.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-8">
            <form action="<?php echo e((isset($siswa) ? route('siswa.update', $siswa->id) : route('siswa.create'))); ?>" method="post" class="card">
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($error); ?><br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <div class="row p-3">
                    <div class="col-12">
                        <?php echo csrf_field(); ?>
                        <div class="form-group mb-3">
                            <label class="form-label">Kelas</label>
                            <select id="select-beast" class="form-control custom-select" name="kelas_id">
                                <?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>" <?php echo e(isset($siswa) ? ($item->id == $siswa->kelas_id ? 'selected' : '') : ''); ?>><?php echo e($item->nama); ?> - <?php echo e(isset($item->periode) ? $item->periode->nama : ''); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" value="<?php echo e(isset($siswa) ? $siswa->nama : old('nama')); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo e(isset($siswa) ? $siswa->email : old('email')); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">NIK</label>
                            <input type="text" class="form-control" name="nik" placeholder="NIK" value="<?php echo e(isset($siswa) ? $siswa->nik : old('nik')); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Tempat, Tanggal Lahir</label>
                            <div class="row gutters-xs">
                                <div class="col-6">
                                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="<?php echo e(isset($siswa) ? $siswa->tempat_lahir : old('tempat_lahir')); ?>">
                                </div>
                                <div class="col-6">
                                    <input type="text" data-toggle="datepicker" class="form-control" name="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo e(isset($siswa) ? $siswa->tanggal_lahir : old('tanggal_lahir')); ?>">
                                </div>
                            </div>  
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select id="select-beast" class="form-control custom-select" name="jenis_kelamin">
                                <option value="L" <?php echo e(isset($siswa) ? ($siswa->jenis_kelamin == 'L' ? 'selected' : '') : ''); ?>>Laki - Laki</option>
                                <option value="P" <?php echo e(isset($siswa) ? ($siswa->jenis_kelamin == 'P' ? 'selected' : '') : ''); ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat"><?php echo e(isset($siswa) ? $siswa->alamat : old('alamat')); ?></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Nama Wali</label>
                            <input type="text" class="form-control" name="nama_wali" placeholder="Nama Lengkap" value="<?php echo e(isset($siswa) ? $siswa->nama_wali : old('nama_wali')); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Telp. Wali</label>
                            <input type="text" class="form-control" name="telp_wali" placeholder="Nomor Telp. Lengkap" value="<?php echo e(isset($siswa) ? $siswa->telp_wali : old('telp_wali')); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Pekerjaan Wali</label>
                            <input type="text" class="form-control" name="pekerjaan_wali" placeholder="Pekerjaan Wali" value="<?php echo e(isset($siswa) ? $siswa->pekerjaan_wali : old('pekerjaan_wali')); ?>">
                        </div>
                        <div class="form-group">
                            <div class="form-label">Anak Yatim Piatu</div>
                            <div class="custom-switch custom-switch-label-onoff">
                                <input type="checkbox" id="check" name="is_yatim" value="1" class="custom-switch-input" <?php echo e(isset($siswa) ? ($siswa->is_yatim ? 'checked' : '') : ''); ?>>
                                <label class="custom-switch-btn" for="check"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger me-3">Batal</a>
                        <button type="submit" class="btn btn-success ml-auto">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<script>
    $(document).ready(function () {
        $('[data-toggle="datepicker"]').datepicker({
            format: 'yyyy-MM-dd'
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\spp-app\resources\views/admin/siswa/form.blade.php ENDPATH**/ ?>
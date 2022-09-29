<?php $__env->startSection('site-name','Sistem Informasi SPP'); ?>
<?php $__env->startSection('page-name', 'Pengaturan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-8">
            <form action="<?php echo e(route('pengaturan.store', $pengaturan->id)); ?>" method="post" class="card" enctype="multipart/form-data">
                <div class="card-header">
                    <h5 class="card-title"><?php echo $__env->yieldContent('page-name'); ?></h5>
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
                                <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?php echo e($pengaturan->nama); ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="oldImage" value="<?php echo e(asset('storage/logo').'/'.str_replace('public/logo/','', $pengaturan->logo)); ?>">
                                <div class="form-label">Logo</div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="logo">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-primary ml-auto ms-2">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\spp-app\resources\views/admin/pengaturan/form.blade.php ENDPATH**/ ?>
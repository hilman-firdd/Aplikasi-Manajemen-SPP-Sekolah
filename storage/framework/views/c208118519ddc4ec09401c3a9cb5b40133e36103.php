<?php $__env->startSection('site-name','Sistem Informasi SPP'); ?>
<?php $__env->startSection('page-name', (isset($user) ? 'Ubah Pengguna' : 'Pengguna Baru')); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-8">
            <form action="<?php echo e((isset($user) ? route('user.update', $user->id) : route('user.create'))); ?>" method="post" class="card">
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
                                <input type="text" class="form-control" name="name" placeholder="Nama" value="<?php echo e(isset($user) ? $user->name : old('name')); ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">EMail</label>
                                <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo e(isset($user) ? $user->email : old('email')); ?>" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" value="" <?php echo e(isset($user) ? '' : 'required'); ?>>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="password_confirmation" value="" <?php echo e(isset($user) ? '' : 'required'); ?>>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <select id="select-beast" class="form-control custom-select" name="role">
                                    <?php if(isset($user->role)): ?>
                                    <?php $__currentLoopData = $user->role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($data->id); ?>" <?php echo e(isset($user) ? ($data->name == $data->name ? 'selected' : '') : ''); ?>><?php echo e($data->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <option value="" disabled>--------------------</option>
                                    <?php endif;?>
                                    <option value="1" <?php echo e(isset($user) ? ($user->role == 'superadmin' ? 'selected' : '') : ''); ?>>superadmin</option>
                                    <option value="2" <?php echo e(isset($user) ? ($user->role == 'admin' ? 'selected' : '') : ''); ?>>admin</option>
                                    <option value="3" <?php echo e(isset($user) ? ($user->role == 'kepsek' ? 'selected' : '') : ''); ?>>kepsek</option>
                                    <option value="4" <?php echo e(isset($user) ? ($user->role == 'bendahara' ? 'selected' : '') : ''); ?>>bendahara</option>
                                    <option value="5" <?php echo e(isset($user) ? ($user->role == 'siswa' ? 'selected' : '') : ''); ?>>siswa</option>
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
<script>
    $(document).ready(function () {
        $('#select-beast').selectize({});
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\spp-app\resources\views/admin/users/form.blade.php ENDPATH**/ ?>
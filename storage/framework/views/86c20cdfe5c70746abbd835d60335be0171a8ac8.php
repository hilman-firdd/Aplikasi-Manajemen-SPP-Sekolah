

<?php $__env->startSection('site-name', 'Sistem Informasi SPP'); ?>
<?php $__env->startSection('page-name', 'Data Siswa'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h3 class="page-title">
            <?php echo $__env->yieldContent('page-name'); ?>
        </h3>
        <div class="d-flex">
            <form action="" method="GET" id="submit-search">
                <div class="input-group mb-3">
                    <div id="klik-search" style="padding:2px; cursor: pointer;">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa fa-search"></i></span>
                    </div>
                    <input type="text" style="height:32px; border-radius-right:12px; margin-left:-8px; margin-top:1px;" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"  placeholder="Cari Siswa" name="q">
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <?php if (app('laratrust')->isAbleTo('siswa-create')) : ?>
                <div class="d-flex justify-content-between p-2">
                    <a href="<?php echo e(route('siswa.create')); ?>" class="btn btn-outline-primary btn-sm ml-5">Tambah Siswa</a>
                    <div class="card-options">
                        <a href="<?php echo e(route('siswa.showimport')); ?>" class="btn btn-primary btn-sm">Import</a>
                        <a href="<?php echo e(route('siswa.export')); ?>" class="btn btn-secondary btn-sm ml-2" download="true">Export</a>
                    </div>
                </div>
                <?php endif; // app('laratrust')->permission ?>
                <?php if(session()->has('msg')): ?>
                <div class="card-alert alert alert-<?php echo e(session()->get('type')); ?>" id="message" style="border-radius: 0px !important">
                    <?php if(session()->get('type') == 'success'): ?>
                        <i class="fe fe-check mr-2" aria-hidden="true"></i>
                    <?php else: ?>
                        <i class="fe fe-alert-triangle mr-2" aria-hidden="true"></i> 
                    <?php endif; ?>
                        <?php echo e(session()->get('msg')); ?>

                </div>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead class="table-light">
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Nik</th>
                            <th>Kelas</th>
                            <th>Nama</th>
                            <th>Wali</th>
                            <th>Telp. Wali</th>
                            <th>Yatim</th>
                            <th>Action</th> 
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (app('laratrust')->hasRole('superadmin|admin|bendahara')) : ?>
                        <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><span class="text-muted"><?php echo e((($index+1) + ($siswa->currentPage() * $siswa->perPage()) - $siswa->perPage())); ?></span></td>
                                <td><?php echo e($item->nik); ?></td>
                                <td><?php echo e((isset($item->kelas) ? $item->kelas->nama : '-')); ?></td>
                                <td>
                                    <a href="<?php echo e(route('siswa.show', $item->id)); ?>" class="link-unmuted">
                                        <?php echo e($item->nama); ?>

                                    </a>
                                </td>
                                <td>
                                    <?php echo e($item->nama_wali); ?>

                                </td>
                                <td>
                                    <?php echo e($item->telp_wali); ?>

                                </td>
                                <td>
                                    <?php if($item->is_yatim): ?>
                                        <span class="tag tag-green">Yatim</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center d-flex align-items-center">
                                    <a class="icon" href="<?php echo e(route('siswa.show', $item->id)); ?>" title="lihat detail">
                                        <i class="fa fa-eye"></i> 
                                    </a>
                                    <?php if (app('laratrust')->isAbleTo('siswa-edit')) : ?>
                                    <a class="icon" href="<?php echo e(route('siswa.edit', $item->id)); ?>" title="edit item">
                                        <i class="fa fa-edit"></i> 
                                    </a> 
                                    <?php endif; // app('laratrust')->permission ?>
                                    <?php if (app('laratrust')->isAbleTo('siswa-delete')) : ?>
                                    <a class="icon btn-delete" href="#!" data-id="<?php echo e($item->id); ?>" title="delete item">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form action="<?php echo e(route('siswa.destroy', $item->id)); ?>" method="POST" id="form-<?php echo e($item->id); ?>">
                                        <?php echo csrf_field(); ?> 
                                        <?php echo method_field('delete'); ?>
                                    </form>
                                    <?php endif; // app('laratrust')->permission ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; // app('laratrust')->hasRole ?>
                        <?php if (app('laratrust')->hasRole('siswa')) : ?>
                        <?php $__currentLoopData = $mySiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><span class="text-muted"><?php echo e($index+1); ?></span></td>
                                <td><?php echo e($item->nik); ?></td>
                                <td><?php echo e((isset($item->kelas) ? $item->kelas->nama : '-')); ?></td>
                                <td>
                                    <a href="<?php echo e(route('siswa.show', $item->id)); ?>" class="link-unmuted">
                                        <?php echo e($item->nama); ?>

                                    </a>
                                </td>
                                <td>
                                    <?php echo e($item->nama_wali); ?>

                                </td>
                                <td>
                                    <?php echo e($item->telp_wali); ?>

                                </td>
                                <td>
                                    <?php if($item->is_yatim): ?>
                                        <span class="tag tag-green">Yatim</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center d-flex align-items-center">
                                    <a class="icon" href="<?php echo e(route('siswa.show', $item->id)); ?>" title="lihat detail">
                                        <i class="fa fa-eye"></i> 
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; // app('laratrust')->hasRole ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <div class="ml-auto mb-0">
                            <?php echo e($siswa->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $(document).ready(function () {

        $(document).on('click','.btn-delete', function(){
            formid = $(this).attr('data-id');
            swal({
                title: 'Anda yakin ingin menghapus?',
                text: 'periode yang dihapus tidak dapat dikembalikan',
                dangerMode: true,
                buttons: {
                    cancel: true,
                    confirm: true,
                },
            }).then((result) => {
                if (result) {
                    $('#form-' + formid).submit();
                }
            })
        })

        $('#klik-search').click(function() {
            $('#submit-search').submit();
        })

    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\spp-app\resources\views/admin/siswa/index.blade.php ENDPATH**/ ?>
<?php $__env->startSection('site-name','Sistem Informasi SPP'); ?>
<?php $__env->startSection('page-name','Pengguna'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1 class="page-title">
            <?php echo $__env->yieldContent('page-name'); ?>
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title"><?php echo $__env->yieldContent('page-name'); ?></h5>
                    <a href="<?php echo e(route('user.create')); ?>" class="btn btn-outline-primary btn-sm ml-5">Tambah Pengguna</a>
                </div>
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
                    
                    <table class="table card-table table-hover table-vcenter text-nowrap">
                        <thead>
                        <tr>
                            <th class="w-1">No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Action</th> 
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><span class="text-muted"><?php echo e($index+1); ?></span></td>
                            <td>
                                <?php if(Auth::user()->id == $item->id): ?>
                                    <span class="tag tag-teal"><?php echo e($item->name); ?></span>
                                <?php else: ?>
                                    <?php echo e($item->name); ?>

                                <?php endif; ?>
                            </td>
                            <td><?php echo e($item->email); ?></td>
                            <td><?php echo e($item->created_at->format('d-m-Y')); ?></td>
                            <td>
                                <?php $__currentLoopData = $item->role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php echo e($data->name); ?>

                                  
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                            </td>
                            <td class="text-center d-flex align-items-center">
                                <a class="icon" href="<?php echo e(route('user.edit', $item->id)); ?>" title="edit item">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <?php if(Auth::user()->id != $item->id): ?>
                                <a class="icon btn-delete" href="#!" data-id="<?php echo e($item->id); ?>" title="delete item">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <?php endif; ?>
                                <form action="<?php echo e(route('user.destroy', $item->id)); ?>" method="POST" id="form-<?php echo e($item->id); ?>">
                                    <?php echo csrf_field(); ?> 
                                </form>
                            </td>
                        </tr>
                        
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <div class="ml-auto mb-0">
                            <?php echo e($users->links()); ?>

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
                    text: 'user yang dihapus tidak dapat dikembalikan',
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

        });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\spp-app\resources\views/admin/users/index.blade.php ENDPATH**/ ?>
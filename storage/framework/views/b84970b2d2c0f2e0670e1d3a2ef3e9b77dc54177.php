<h2 style="text-align:center"><b> <?php echo e($sitename); ?> </b></h2 >
    <h3 style="text-align:center">Laporan Harian</h3>
    <p><b>Tanggal :</b> <?php echo e($date); ?> </p>
<table style="border: 1px solid black; width: 100%">
    <thead style="border: 1px solid black;">
    <tr>
        <th><b>Tanggal</b></th>
        <th><b>Nama</b></th>
        <th><b>Pembayaran</b></th>
        <th><b>Total</b></th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr class="<?php echo e(($index%2) ? 'gray' : ''); ?>">
            <td><?php echo e($item->created_at->format('d-m-Y')); ?></td>
            <td><?php echo e($item->siswa->nama." (".$item->siswa->kelas->nama.")"); ?></td>
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
<?php if(isset($print)): ?>
<style>
@media  print {
    tr.gray {
        background-color: #ececec !important;
        -webkit-print-color-adjust: exact; 
    }
    th {
        background-color: #dadada !important;
        -webkit-print-color-adjust: exact; 
    }
}
</style>
<script>
    window.print()
    window.onafterprint = function(){
        window.close()
    }
</script>
<?php endif; ?><?php /**PATH C:\laragon\www\spp-app\resources\views/admin/dashboard/export.blade.php ENDPATH**/ ?>
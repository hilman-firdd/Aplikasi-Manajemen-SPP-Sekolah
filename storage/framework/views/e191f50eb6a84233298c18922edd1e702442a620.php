<h2 style="text-align:center"><b> <?php echo e($sitename); ?> </b></h2>
<h3 style="text-align:center">Tanda Bukti Pembayaran</h3>
<br>
<p><b>Nama :</b> <?php echo e($siswa->nama); ?> <b>Kelas : </b> <?php echo e($siswa->kelas->nama); ?><?php echo e(isset($siswa->kelas->periode) ?
    '('.$siswa->kelas->periode->nama.')' : ''); ?></p>
<p><b>Tanggal : </b> <?php echo e($tanggal); ?></p>
<table style="border: 1px solid black; width: 100%">
    <tr style="border: 1px solid black;">
        <th>No</th>
        <th width="5%">Tagihan</th>
        <th>Tanggal</th>
        <th>Jumlah</th>
        <th>Keterangan</th>
    </tr>
    <?php $__currentLoopData = $transaksi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr class="<?php echo e(($index%2) ? 'gray' : ''); ?>">
        <td style="min-width:20px;text-align: center;">
            <?php echo e($index+1); ?>

        </td>
        <td style="min-width:100px;text-align: center;">
            <?php echo e($item->tagihan->nama); ?>

        </td>
        <td style="min-width:100px;text-align: center;">
            <?php echo e($item->created_at->format('d-m-Y')); ?>

        </td>
        <td style="min-width:200px;text-align: left;">
            Rp. <?php echo e(format_idr($item->keuangan->jumlah)); ?>

        </td>
        <td style="min-width:20px;text-align: center;">
            <?php echo e($item->keterangan); ?>

        </td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
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
</script><?php /**PATH C:\laragon\www\spp-app\resources\views/admin/transaksi/print.blade.php ENDPATH**/ ?>
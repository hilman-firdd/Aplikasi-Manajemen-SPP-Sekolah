<?php $__env->startSection('page-name','Kuitansi'); ?>
<style type="text/css">
    @media  screen {
        p {
            font-family: verdana, arial, sans-serif;
        }
    }

    @media  screen {
        p {
            font-family: georgia, times, serif;
        }
    }

    @media  screen,
    print {
        p {
            font-size: 8pt;
        }

        h5 {
            font-size: 7pt;
        }

        table {
            font-size: 15px;
        }
    }
</style>
<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1 class="page-title">
        Kuitansi
    </h1>
</div>
<div class="row">
    <div class="col-12">
        <div class="card" id="print">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <h5><?php echo e($sitename); ?></h5>
                        <p>Invoice: <span id="invoice"><?php echo e(now()->format('YmdHis')); ?></span></p>
                    </div>
                    <div class="col-3">
                        <div class="d-flex">
                            <p class="ml-auto">
                                Tanggal : <?php echo e(now()->format('d-m-Y')); ?><br>
                                Nama : <?php echo e(Auth::user()->name); ?>

                            </p>
                        </div>
                    </div>
                    <hr class="bg-color">
                    <table class="table card-table table-hover table-vcenter text-wrap title" id="print">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="newrow"></tr>
                        </tbody>
                    </table>
                    <div class="btn btn-outline-primary col-12 btn-sm" title="tambah baris" id="tambah">
                        <span class="fa fa-plus"></span>
                    </div>
                    <table class="table card-table table-vcenter text-wrap title">
                        <tr>
                            <td style="width: 60%"></td>
                            <td style="width: 20%;text-align: right;"><b>TOTAL</b></td>
                            <td style="width: 20%;">IDR. <span id="total">0</span></td>
                        </tr>
                        <tr>
                            <td style="width: 60%"></td>
                            <td style="width: 20%;text-align: left;">
                                <b>Tanda Terima</b>
                                <br>
                                <br>
                                <br>
                                <br>
                                <p>............................</p>
                            </td>
                            <td style="width: 20%;text-align: left;">
                                <b>Hormat Kami</b>
                                <div style="position: relative">
                                    <img src="<?php echo e(asset('ttd.png')); ?>" width="70" height="70" />
                                </div>
                                <p><?php echo e($user[2]->name); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
            <div class="card-footer">
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary ml-auto" id="cetak">Simpan</button>
                    <button type="submit" class="btn btn-secondary ms-2" id="baru">Baru</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12" id="histori">
        <div class="card">
            <div class="card-header">
                <p class="card-title">Histori</p>
            </div>
            <div class="card-body">
                <table class="table card-table table-hover table-vcenter text-nowrap title" id="print">
                    <tr>
                        <th>Tanggal</th>
                        <th>Invoice</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                    <?php $__currentLoopData = $kuitansi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->created_at->format('d-m-Y')); ?></td>
                        <td><?php echo e($item->invoice); ?></td>
                        <td>IDR. <?php echo e(format_idr($item->total)); ?></td>
                        
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<script>
    $(document).ready(function () {
                $('#cetak').on('click',function(){
                    $(this).hide()
                    $('#navbar-sidebar').hide()
                    $('.page-title').hide()
                    $('#tambah').hide()
                    $('.hapus').hide()
                    $('#histori').toggle()
                    $('#baru').toggle()
                    
                    window.print()

                    var string = [];
                    var index = 0;
                    $('input').each(function(){
                        if(this.name == 'nama'){
                            index += 1
                        }
                        string.push({
                            num: index,
                            key: this.name,
                            value: this.value
                        })
                    })

                    $.ajax({
                        type: "POST",
                        url: "<?php echo e(route('kuitansi.store')); ?>",
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>',
                            invoice: $('#invoice').text(),
                            data: string,
                            total: seluruh
                        },
                        success: function(data){
                            console.log(data)
                        }
                    })
                })
            });
            window.onafterprint = function(){
                    $('#cetak').show()
                    $('#histori').toggle()
                    $('.page-title').show()
                    $('#tambah').show()
                    $('.hapus').show()
                    $('#baru').toggle()
            }
            var index = 0
            $('#tambah').on('click', function(){
                index = index+1
                $('#newrow').before('<tr id="baris-' + index +'">' +
                                    '<td style="width:60%;">'+
                                        '<div class="row">' +
                                            '<div class="col-11">' +
                                                '<input type="text" class="form-control" name="nama">' +
                                            '</div>' +
                                            '<div class="col-1">' +
                                                '<button class="btn btn-secondary hapus" title="hapus item" type="button" value="'+ index +'"><i class="fa fa-trash"></i></button>'+
                                            '</div>'+
                                        '</div>'+ 
                                    '</td>' +
                                    '<td><input type="number" min=0 class="form-control" name="jumlah" id="jumlah-'+ index +'"></td>' +
                                    '<td><input type="number" min=0 class="form-control harga" name="harga" data-id="'+ index +'"></td>' +
                                "</tr>")
            })
            var seluruh = 0;
            $(document).on('keyup','.harga', function(){
                seluruh = 0;
                $('.harga').each(function() {
                    if(this.value != ''){
                        id = $(this).attr('data-id')
                        jumlah = $('#jumlah-' + id).val()
                        if(jumlah != ''){
                            jumlah = parseInt(jumlah, 10)
                            sol = parseInt((this.value * jumlah), 10)
                        }else{
                            sol = this.value
                        }
                        seluruh += parseInt(sol, 10)
                    }
                });
                $('#total').text(seluruh);
            })
            $('#baru').on('click', function(){
                window.location.reload()
            })
            $(document).on('click','.hapus', function(){
                id = this.value
                console.log(id)
                $('#baris-'+id).remove()
                // $(this).remove()
            })
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\spp-app\resources\views/admin/kuitansi/index.blade.php ENDPATH**/ ?>
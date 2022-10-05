<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="description" content="Aplikasi SPP Dashboard Page" />
  <meta name="keywords" content="HTML, CSS, JavaScript, Bootstrap, Chart JS" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="token" content="<?php echo e(csrf_token()); ?>" />
  <meta name="author" content="Hilman Firdaus" />

  <title>Aplikasi SPP - Dashboard</title>

  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />

  <!-- External CSS -->
  <link rel="stylesheet" href="<?php echo e(asset('template/assets/css/styles.css')); ?>" type="text/css" media="screen" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="<?php echo e(asset('template/assets/plugins/datepicker/datepicker.css')); ?>" rel="stylesheet" />
  <!-- Dashboard Core -->
  
  
  <!-- requirejs and Custom CSS -->
  <?php echo $__env->yieldPushContent('css'); ?>
</head>

<body>
  <!-- Nav Sidebar -->
  <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


  <!-- Main Content -->
  <main class="content">
    <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
  </main>

  <!-- Bootstrap JS -->
  
  

  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"
    integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
  <script>
    $(document).ready(function () {
        $('.sidebarCollapseDefault').on('click', function () {
          $('.sidebar').toggleClass('active');
          $('.content').toggleClass('active');
        });
      });
  </script>
  <!-- Custom JS -->
  <?php echo $__env->yieldPushContent('js'); ?>
</body>

</html><?php /**PATH C:\laragon\www\spp-app\resources\views/layouts/master.blade.php ENDPATH**/ ?>
<!doctype html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta http-equiv="Content-Language" content="en" />
	<meta name="msapplication-TileColor" content="#2d89ef">
	<meta name="theme-color" content="#4188c9">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<link rel="icon" href="<?php echo e(asset('favicon.ico')); ?> " type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
	<!-- Generated: 2018-04-16 09:29:05 +0200 -->
	<title>Selamat Datang | Masuk</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
	<!-- Dashboard Core -->
	<link href="<?php echo e(asset('css/dashboard.css')); ?>" rel="stylesheet" />
</head>
<body class="">
    <div class="page">
        <div class="page-single">
            <div class="container">
                <div class="row">
                    <div class="col col-login mx-auto">
                        <form class="card" action="<?php echo e(route('login')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="card-body p-6">
                                <div class="text-center mb-2">
                                    <img src="<?php echo e(asset('template/assets/images/logo.png')); ?>" class="h-8 w-8" alt="">
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Email/Username</label>
									<input type="text" class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="username" value="<?php echo e(old('username')); ?>" placeholder="Masukan Email/Username" value="<?php echo e(old('username')); ?>" autofocus>
                                    <?php if($errors->has('username')): ?>
                                        <small class="form-text invalid-feedback" style="display: block !important"><?php echo e($errors->first('username')); ?></small>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control <?php echo e(($errors->has('password')) ? 'is-invalid' : ''); ?>" id="exampleInputPassword1" placeholder="Password">
                                    <?php if($errors->has('password')): ?>
                                            <small class="form-text invalid-feedback"><?php echo e($errors->first('password')); ?></small>
                                    <?php endif; ?>
                                </div>
                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\laragon\www\spp-app\resources\views/auth/login.blade.php ENDPATH**/ ?>
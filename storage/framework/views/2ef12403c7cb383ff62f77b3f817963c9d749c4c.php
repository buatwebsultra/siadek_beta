<?php
    $base_aset = asset('komponen/login');
    $levelPath = Request::get('levelPath');
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | <?php echo e($appData->app_nama ?? 'SIADEK'); ?></title>
    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo e(asset($appData->app_icon ?? 'favicon.ico')); ?>" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e($base_aset); ?>/css/login.css">
</head>

<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card login-card">
                        <div class="row no-gutters">
                            
                            <div class="col-md-12 text-center">
                                <div class="card-body">
                                    <div class="brand-wrapper">
                                        <img src="<?php echo e(asset($appData->app_logo ?? 'komponen/login/images/logo_stikes_pi.png')); ?>" alt="logo" class=""
                                            style="width: 270px">
                                    </div>
                                    <p class="login-card-description">Masuk</p>
                                    <?php $__errorArgs = ['errorLogin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong><i class="fas fa-ban"></i> Error !</strong> <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    <form action="<?php echo e(route('login.gas')); ?>" method="POST"
                                        style="width: 100% !important; max-width: none !important">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <label for="username" class="sr-only">Username</label>
                                            <input type="text" name="username" id="username" class="form-control"
                                                placeholder="Username" minlength="3"
                                                value="<?php echo e(old('username')); ?>" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="password" class="sr-only">Password</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Password" minlength="4" required>
                                        </div>
                                        <button class="btn btn-block login-btn mb-4" type="submit">Login</button>
                                    </form>
                                    <a href="#!" class="forgot-password-link">Lupa password?</a>
                                    
                                    <nav class="login-card-footer-nav">
                                        <a href="#!">2022 &copy; <?php echo e($appData->app_nama ?? 'SIADEK'); ?> </a>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>
<?php /**PATH D:\PROJECT\siadek_beta\resources\views/z_auth/login.blade.php ENDPATH**/ ?>
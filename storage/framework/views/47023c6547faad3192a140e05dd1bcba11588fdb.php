<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('pageName', '404'); ?>
<?php $__env->startSection('body'); ?>
    <!-- Your text -->
    <h1>Oops! Error 404 (not found)</h1>

    <p>Halaman yang anda cari tidak ditemukan<br>
        <a href="<?php echo e(route('login')); ?>" class="btn btn-default btn-outline-inverse"><i
                class="icofont icofont-exchange"></i>Kembali</a>
    </p>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('_layouts.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\PROJECT\siadek_beta\resources\views/errors/404.blade.php ENDPATH**/ ?>
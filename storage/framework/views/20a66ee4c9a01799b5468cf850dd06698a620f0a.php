<select class="col-sm-12 select2" name="jur_pilih" id="jur_pilih" onchange="initPilihJurusan(this)" required>
    <option value="all">-- Semua Prodi --</option>
    <?php $__currentLoopData = $jurusan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($jur->jur_id); ?>"><?php echo e($jur->jur_nama); ?> -
            (<?php echo e($jur->jur_jenjang); ?>)
        </option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>

<?php $__env->startPush('additional_script'); ?>
    <script type="text/javascript">
        $('#jur_pilih').select2();
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH D:\PROJECT\siadek_beta\resources\views/_komponen/form_pilih_jurusan.blade.php ENDPATH**/ ?>
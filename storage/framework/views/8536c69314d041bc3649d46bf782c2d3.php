

<?php $__env->startSection('content'); ?>
<div class="card bg-coklat fs-5">
    <div class="card-header">Edit KKM: <?php echo e($kkm->kuis_id); ?></div>
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('admin.kkm.update', $kkm)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="mb-3">
                <label>KKM <small class="text-muted">(minimal <?php echo e($minKkm); ?>, maksimal <?php echo e($maxKkm); ?>)</small></label>
                <input type="number" name="kkm" class="form-control"
                       min="<?php echo e($minKkm); ?>" max="<?php echo e($maxKkm); ?>"
                       value="<?php echo e($kkm->kkm); ?>" required step="1">
                <small class="form-text text-muted">
                    Nilai KKM minimal = <?php echo e($minKkm); ?> (benar 1 soal), maksimal = 100.
                </small>
                <?php $__errorArgs = ['kkm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <button type="submit" class="btn btn-primary fs-5">Update</button>
            <a href="<?php echo e(route('admin.kkm.index')); ?>" class="btn btn-secondary fs-5">Kembali</a>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-guru', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/admin/kkm/edit.blade.php ENDPATH**/ ?>
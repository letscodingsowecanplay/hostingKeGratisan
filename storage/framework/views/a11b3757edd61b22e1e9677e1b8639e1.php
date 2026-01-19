

<?php $__env->startSection('content'); ?>
<div class="card bg-coklat fs-5">
    <div class="card-header">Edit Siswa</div>
    <div class="card-body">
        <form method="POST" action="<?php echo e(route('admin.datasiswa.update', $user->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $user->name)); ?>" required>
            </div>

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $user->email)); ?>" required>
            </div>

            <div class="mb-3">
                <label for="nisn">NISN</label>
                <input type="text" name="nisn" class="form-control" value="<?php echo e(old('nisn', $user->nisn)); ?>" required>
            </div>

            <div class="mb-3">
                <label for="password">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary fs-5">Update</button>
            <a href="<?php echo e(route('admin.datasiswa.index')); ?>" class="btn btn-secondary fs-5">Kembali</a>
        </form>
    </div>
</div>
<br>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-guru', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/admin/datasiswa/edit.blade.php ENDPATH**/ ?>
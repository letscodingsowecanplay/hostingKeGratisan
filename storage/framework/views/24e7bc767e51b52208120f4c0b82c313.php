

<?php $__env->startSection('title', 'Login Guru'); ?>

<?php $__env->startSection('content'); ?>
<div class="login-page-wrap">
    <div class="login-card-color">
        <div class="login-logo">
            <img src="<?php echo e(asset('images/Logo-Si-Ukur.png')); ?>" alt="Logo Si Ukur">
        </div>
        <div class="login-title">
            Login Guru
        </div>
        <form method="POST" action="<?php echo e(route('login.guru')); ?>" class="login-form-multicolor">
            <?php echo csrf_field(); ?>
            <div class="input-group-custom">
                <label for="identity">NIP</label>
                <div class="input-nip">
                    <input
                        id="identity"
                        type="text"
                        class="<?php $__errorArgs = ['identity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="identity"
                        value="<?php echo e(old('identity')); ?>"
                        required autocomplete="identity"
                        autofocus
                        placeholder="Masukkan NIP"
                    >
                </div>
                <?php $__errorArgs = ['identity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="input-group-custom">
                <label for="password">Kata Sandi</label>
                <div class="input-sandi">
                    <input
                        id="password"
                        type="password"
                        class="<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="Masukkan Kata Sandi"
                    >
                </div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <button type="submit" class="btn-login-custom">
                Masuk
            </button>
            <?php if($errors->has('identity') || $errors->has('password')): ?>
                <div class="invalid-feedback text-center mt-2">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div><?php echo e($error); ?></div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/auth/loginGuru.blade.php ENDPATH**/ ?>
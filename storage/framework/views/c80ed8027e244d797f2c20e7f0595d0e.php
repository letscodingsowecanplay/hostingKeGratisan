

<?php $__env->startSection('content'); ?>
    <div class="card bg-coklat fs-5" style="box-shadow: 0 3px 24px #0000000e;">
        <div class="card-header d-flex justify-content-between align-items-center" style="background: none; border: none; font-size: 1.16em; font-weight: 700; color: #258fff;">
            <div class="float-start">
                Data Latihan Siswa
            </div>
            <form method="GET" class="d-flex gap-2">
                <select name="kuis_id" class="form-select form-select-sm fs-5" style="max-width:200px;">
                    <option value="">-- Semua Latihan --</option>
                    <?php $__currentLoopData = $kuisIds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kuis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($kuis); ?>" <?php echo e($kuisDipilih == $kuis ? 'selected' : ''); ?>>
                            <?php echo e(ucfirst(str_replace('-', ' ', $kuis))); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <button type="submit" class="btn btn-primary btn-sm fs-5">Filter</button>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NISN</th>
                            <th>Nilai</th>
                            <th>Hari</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $nilai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration + ($nilai->firstItem() - 1)); ?></td>
                                <td><?php echo e($row->user->name); ?></td>
                                <td><?php echo e($row->user->nisn ?? '-'); ?></td>
                                <td><?php echo e($row->skor); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($row->created_at)->format('j/n/Y')); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($row->created_at)->format('H.i.s')); ?></td>
                                <td>
                                    <form action="<?php echo e(route('admin.datalatihan.destroy', $row->id)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="badge bg-danger border-0 fs-5">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer custom-pagination">
            <?php echo e($nilai->links()); ?>

        </div>
    </div>
    <br>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-guru', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/admin/datalatihan/index.blade.php ENDPATH**/ ?>
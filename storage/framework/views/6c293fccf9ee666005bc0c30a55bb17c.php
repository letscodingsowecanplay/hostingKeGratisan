<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NISN</th>
            <th>Nilai</th>
            <th>Hari</th>
            <th>Waktu</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $nilai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($i + 1); ?></td>
                <td><?php echo e($row->user->name); ?></td>
                <td><?php echo e($row->user->nisn ?? '-'); ?></td>
                <td><?php echo e($row->skor); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($row->created_at)->format('j/n/Y')); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($row->created_at)->format('H.i.s')); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/admin/hasilbelajar/export_excel.blade.php ENDPATH**/ ?>
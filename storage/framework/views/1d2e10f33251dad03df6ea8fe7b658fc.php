<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Hasil Belajar Siswa</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0;}
        th, td { border: 1px solid #333; padding: 4px; text-align: left; }
    </style>
</head>
<body>
    <h3>Data Hasil Belajar Siswa</h3>
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
</body>
</html>
<?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/admin/hasilbelajar/export_pdf.blade.php ENDPATH**/ ?>
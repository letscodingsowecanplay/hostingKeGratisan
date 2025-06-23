

<?php $__env->startSection('content'); ?>
<div class="center-dashboard-container"><br>
    <div style="text-align:center; margin-bottom: 18px; margin-top: -16px;">
        <h2 style="font-family:'Montserrat',Arial,sans-serif; font-weight: 700; font-size:2.1rem; color:rgb(0, 0, 0); letter-spacing:1px; margin-bottom:0;">
            Dashboard
        </h2>
    </div>
    <div class="dashboard-bar">

        <!-- Card 1: Welcome -->
        <div class="card-box yellow-card">
            <div class="card-content-wrap">
                <div style="margin-bottom:13px;">
                    <!-- Feather icon: Users -->
                    <svg style="width: 36px; height: 36px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                         stroke="#bf9700" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m13-5a4 4 0 11-8 0 4 4 0 018 0zM7 8a4 4 0 100 8 4 4 0 000-8z" />
                    </svg>
                </div>
                <div class="card-title">Selamat datang,</div>
                <div class="card-content">
                    <?php echo e(auth()->user()->name); ?><br><br>
                    <span style="font-size:0.97em;">
                        <?php $roles = auth()->user()->getRoleNames()->toArray(); ?>
                        <?php echo e(implode(" ", $roles)); ?>

                    </span>
                </div>
            </div>
        </div>

        <!-- Card 2: Capaian Pembelajaran -->
        <div class="card-box green-card">
            <div class="card-content-wrap">
                <div style="margin-bottom:13px;">
                    <!-- Feather icon: Book Open -->
                    <svg style="width: 36px; height: 36px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="#187d5e" stroke-width="2">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                    </svg>
                </div>
                <div class="card-title">Capaian Pembelajaran</div>
                <div class="card-content">
                    Pada akhir Fase A, peserta didik dapat membandingkan panjang dan berat benda secara langsung.<br>
                    Mereka dapat mengukur dan mengestimasi panjang benda menggunakan satuan tidak baku.
                </div>
            </div>
        </div>

        <?php if(auth()->user()->hasRole('Admin')): ?>
        <!-- Card 3: Menu Guru (4 tombol 2x2) -->
        <div class="card-box" style="background:linear-gradient(120deg,#ede574,#e1f5c4); box-shadow:0 2px 12px rgba(64,132,55,0.08);">
            <div class="card-content-wrap">
                <div style="margin-bottom:13px;">
                    <!-- Feather icon: Settings -->
                    <svg style="width: 36px; height: 36px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="#41861e" stroke-width="2">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 8 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 5 15.4a1.65 1.65 0 0 0-1.51-1V13a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 5 8.6a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 8 4.6c.2-.09.41-.14.63-.14H12a1.65 1.65 0 0 0 1-.33z"/>
                    </svg>
                </div>
                <div class="card-title" style="margin-bottom:18px;">Menu Guru</div>
                <div class="admin-menu-grid">
                    <!-- Tombol Data Siswa -->
                    <a href="<?php echo e(route('admin.datasiswa.index')); ?>" class="menu-btn menu-btn-yellow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="#bf9700" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 0 0-3-3.87M9 20H4v-2a4 4 0 0 1 3-3.87m13-5a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM7 8a4 4 0 1 0 0 8 4 4 0 0 0 0-8z"/></svg>
                        <span>Data Siswa</span>
                    </a>
                    <!-- Tombol Data Latihan Siswa -->
                    <a href="<?php echo e(route('admin.datalatihan.index')); ?>" class="menu-btn menu-btn-green">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="#26b88a" stroke-width="2" viewBox="0 0 24 24"><path d="M3 17v-5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v5M7 22h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2z"/><path d="M16 3v2M8 3v2"/></svg>
                        <span>Data Latihan Siswa</span>
                    </a>
                    <!-- Tombol Hasil Belajar Siswa -->
                    <a href="<?php echo e(route('admin.hasilbelajar.index')); ?>" class="menu-btn menu-btn-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="#246bba" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                        <span>Hasil Belajar Siswa</span>
                    </a>
                    <!-- Tombol Atur KKM -->
                    <a href="<?php echo e(route('admin.kkm.index')); ?>" class="menu-btn menu-btn-orange">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" stroke="#f57f17" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 3v4M8 3v4"/></svg>
                        <span>Atur KKM</span>
                    </a>
                </div>
            </div>
        </div>
        <style>
            .admin-menu-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }
            .menu-btn {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 16px 6px 10px 6px;
                border-radius: 18px;
                font-weight: 600;
                font-size: 1.09em;
                text-decoration: none;
                box-shadow: 0 2px 8px rgba(150,150,150,0.11);
                transition: box-shadow .18s, transform .12s;
                background: #fff;
                min-height: 90px;
            }
            .menu-btn svg { margin-bottom: 8px; }
            .menu-btn-yellow { border: 2.2px solid #ffe680; }
            .menu-btn-green { border: 2.2px solid #bbf7d0; }
            .menu-btn-blue { border: 2.2px solid #aee1fa; }
            .menu-btn-orange { border: 2.2px solid #ffebb2; }
            .menu-btn:hover { box-shadow: 0 4px 16px rgba(90,90,90,0.14); transform: translateY(-2px) scale(1.024); }
        </style>
        <?php else: ?>
        <!-- Card siswa/guru lain -->
        <div class="card-box blue-card">
            <div class="card-content-wrap">
                <div style="margin-bottom:13px;">
                    <!-- Feather icon: Book -->
                    <svg style="width: 36px; height: 36px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="#246bba" stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M20 19.5V17A2.5 2.5 0 0 0 17.5 14H4"/>
                        <path d="M4 19.5V6.5A2.5 2.5 0 0 1 6.5 4H20"/>
                        <path d="M20 6.5V4A2.5 2.5 0 0 0 17.5 1.5H4"/>
                    </svg>
                </div>
                <div class="card-title">Mulai Belajar</div>
                <div class="card-content">Akses materi pembelajaran dan latihan interaktif.</div>
                <a href="<?php echo e(route('admin.materi.index')); ?>" class="card-btn">Mulai Belajar</a>
            </div>
        </div>
        <div class="card-box orange-card position-relative" id="card-evaluasi-container">
            <div class="card-content-wrap">
                <div style="margin-bottom:13px;">
                    <!-- Feather icon: Message Square (Evaluasi) -->
                    <svg style="width: 36px; height: 36px;" xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 24 24"
                        fill="none" stroke="#f57f17" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-message-square align-middle text-info">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                </div>
                <div class="card-title">Mulai Evaluasi</div>
                <div class="card-content">Kerjakan evaluasi sebagai penutup pembelajaran.</div>
                <a id="card-evaluasi-link" href="<?php echo e(route('admin.evaluasi.petunjuk')); ?>" class="card-btn">Mulai Evaluasi</a>
                <!-- Overlay Gembok -->
                <div id="gembok-evaluasi-overlay" class="gembok-overlay d-none"
                    style="position:absolute;top:0;left:0;width:100%;height:100%;background:rgba(255,255,255,0.65);border-radius:28px;display:flex;align-items:center;justify-content:center;z-index:3;">
                    <span data-feather="lock" class="gembok-lock-icon" style="color:#d84b2f;font-size:2.2rem;"></span>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
window.initKunciCardEvaluasi = function(statusLulus) {
    const bolehEvaluasi = statusLulus && statusLulus['ayo-berlatih-3'] === 'lulus';
    const overlay = document.getElementById('gembok-evaluasi-overlay');
    const link = document.getElementById('card-evaluasi-link');

    if (!overlay || !link) return;

    if (!bolehEvaluasi) {
        overlay.classList.remove('d-none');
        link.classList.add('locked');
        link.removeAttribute('href');
    } else {
        overlay.classList.add('d-none');
        link.classList.remove('locked');
        link.setAttribute('href', "<?php echo e(route('admin.evaluasi.petunjuk')); ?>");
    }
    if (window.feather) window.feather.replace();
}
document.addEventListener('DOMContentLoaded', function() {
    window.initKunciCardEvaluasi(<?php echo json_encode($statusLulus ?? [], 15, 512) ?>);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\si-ukur\resources\views/admin/index.blade.php ENDPATH**/ ?>
<?= $this->extend('layout/app'); ?>

<?= $this->section('content'); ?>
<div class="min-h-screen flex items-center justify-center bg-soft px-6">
    <div class="bg-white p-10 border border-line shadow-lg w-full max-w-sm">
        <h2 class="text-2xl font-bold mb-6 text-center text-dark">Portal Eksekutif</h2>
        
        <?php if (session()->getFlashdata('error')): ?>
            <p class="text-red-500 text-sm mb-4"><?= session()->getFlashdata('error'); ?></p>
        <?php endif; ?>

        <form action="<?= base_url('login/auth'); ?>" method="post">
            <?= csrf_field(); ?>
            <input type="text" name="username" placeholder="Username" class="w-full border border-line p-3 mb-4" required>
            <input type="password" name="password" placeholder="Password" class="w-full border border-line p-3 mb-6" required>
            <button type="submit" class="w-full bg-dark text-white py-3 font-bold hover:bg-slate-800 transition">
                Masuk
            </button>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
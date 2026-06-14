<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>
<div class="max-w-4xl mx-auto py-10 px-6">
    <h2 class="text-2xl font-bold mb-8 text-dark">Kelola Pengumuman Top Bar</h2>
    
    <form action="<?= base_url('portal/pengumuman/update'); ?>" method="post" class="bg-white p-8 border border-gray-200 shadow-sm">
        <?= csrf_field(); ?>
        <input type="hidden" name="id" value="<?= $pengumuman[0]['id'] ?? 1; ?>">
        
        <div class="mb-6">
            <label class="block text-sm font-semibold mb-2 text-gray-700">Isi Pengumuman</label>
            <textarea name="isi" class="w-full border border-gray-300 p-3 rounded focus:ring-2 focus:ring-primary outline-none" rows="3"><?= $pengumuman[0]['isi_pengumuman'] ?? ''; ?></textarea>
        </div>
        
        <div class="mb-6 flex items-center">
            <input type="checkbox" name="status" id="status" class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary" <?= ($pengumuman[0]['is_active'] ?? 0) ? 'checked' : ''; ?>>
            <label for="status" class="ml-2 text-gray-700">Aktifkan di Beranda</label>
        </div>
        
        <button type="submit" class="w-full md:w-auto bg-red-600 text-white px-8 py-3 font-bold hover:bg-red-700 transition rounded shadow-md">
            Simpan Perubahan
        </button>
    </form>
</div>
<?= $this->endSection(); ?>
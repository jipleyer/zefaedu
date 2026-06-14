<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>
<div class="max-w-4xl mx-auto">
    <div class="bg-white p-8 shadow-sm border border-gray-200 rounded-lg">
        <div class="text-right">
            <h2 class="text-3xl font-bold text-dark mb-2 font-['Amiri']">
                مرحباً بك يا مدير
            </h2>
            <p class="text-gray-600 text-lg font-['Amiri']">
                نسأل الله أن يبارك في يومك هذا
            </p>
        </div>
    </div>

    <div class="mt-8 grid md:grid-cols-2 gap-6">
        <div class="bg-white p-6 shadow-sm border border-gray-200">
            <h3 class="font-bold text-gray-700">Manajemen Blog</h3>
            <p class="text-sm text-gray-500 mt-2">Kelola konten strategis Anda di sini.</p>
        </div>
        <div class="bg-white p-6 shadow-sm border border-gray-200">
            <h3 class="font-bold text-gray-700">Pengumuman</h3>
            <p class="text-sm text-gray-500 mt-2">Update info terkini untuk audiens.</p>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
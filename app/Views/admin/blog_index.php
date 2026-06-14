<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Blog</h2>
        <a href="<?= base_url('portal/blog/create'); ?>" class="bg-primary hover:bg-red-700 text-white px-6 py-2 rounded font-semibold transition">
            + Create Blog
        </a>
    </div>

    <div class="bg-white shadow-sm border border-gray-200 rounded-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="p-4 font-semibold text-gray-700">Judul Artikel</th>
                    <th class="p-4 font-semibold text-gray-700">Dibuat</th>
                    <th class="p-4 font-semibold text-gray-700 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if (!empty($blogs)): ?>
                    <?php foreach ($blogs as $blog): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-gray-800 font-medium"><?= esc($blog['judul']); ?></td>
                        <td class="p-4 text-gray-500 text-sm"><?= date('d M Y', strtotime($blog['created_at'])); ?></td>
                        <td class="p-4 text-center">
                            <div class="flex justify-center gap-3">
                                <a href="<?= base_url('blog/' . $blog['slug']); ?>" target="_blank" class="text-green-600 hover:text-green-800 font-medium text-sm">View</a>
                                
                                <a href="<?= base_url('portal/blog/edit/' . $blog['id']); ?>" class="text-blue-600 hover:text-blue-800 font-medium text-sm">Edit</a>
                                
                                <a href="<?= base_url('portal/blog/delete/' . $blog['id']); ?>" 
                                   class="text-red-600 hover:text-red-800 font-medium text-sm" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                   Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="p-8 text-center text-gray-500">Belum ada artikel yang tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>
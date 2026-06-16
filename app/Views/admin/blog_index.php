<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>
<div class="max-w-6xl mx-auto px-4">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <h2 class="text-2xl font-bold text-gray-800">Manajemen Blog</h2>
        <a href="<?= base_url('portal/blog/create'); ?>" class="w-full md:w-auto bg-primary hover:bg-red-700 text-white px-6 py-2 rounded font-semibold transition text-center">
            + Create Blog
        </a>
    </div>

    <div class="hidden md:block bg-white shadow-sm border border-gray-200 rounded-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="p-4 font-semibold text-gray-700">Judul & Tag</th>
                    <th class="p-4 font-semibold text-gray-700">Dibuat</th>
                    <th class="p-4 font-semibold text-gray-700 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if (!empty($blogs)): ?>
                    <?php foreach ($blogs as $blog): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4">
                            <p class="text-gray-800 font-medium"><?= esc($blog['judul']); ?></p>
                            <div class="flex flex-wrap gap-1 mt-1">
                                </div>
                        </td>
                        <td class="p-4 text-gray-500 text-sm"><?= date('d M Y', strtotime($blog['created_at'])); ?></td>
                        <td class="p-4 text-center">
                            <div class="flex justify-center gap-3">
                                <a href="<?= base_url('blog/' . $blog['slug']); ?>" target="_blank" class="text-green-600 hover:text-green-800 font-medium text-sm">View</a>
                                <a href="<?= base_url('portal/blog/edit/' . $blog['id']); ?>" class="text-blue-600 hover:text-blue-800 font-medium text-sm">Edit</a>
                                <a href="<?= base_url('portal/blog/delete/' . $blog['id']); ?>" class="text-red-600 hover:text-red-800 font-medium text-sm" onclick="return confirm('Yakin hapus?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="3" class="p-8 text-center text-gray-500">Belum ada artikel.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="md:hidden space-y-4">
        <?php if (!empty($blogs)): ?>
            <?php foreach ($blogs as $blog): ?>
            <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                <h3 class="font-bold text-gray-800 mb-2"><?= esc($blog['judul']); ?></h3>
                <p class="text-xs text-gray-500 mb-4"><?= date('d M Y', strtotime($blog['created_at'])); ?></p>
                <div class="flex gap-4 border-t pt-3">
                    <a href="<?= base_url('blog/' . $blog['slug']); ?>" class="text-green-600 font-semibold text-sm">View</a>
                    <a href="<?= base_url('portal/blog/edit/' . $blog['id']); ?>" class="text-blue-600 font-semibold text-sm">Edit</a>
                    <a href="<?= base_url('portal/blog/delete/' . $blog['id']); ?>" class="text-red-600 font-semibold text-sm">Delete</a>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection(); ?>
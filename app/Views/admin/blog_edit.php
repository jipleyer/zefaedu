<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>
<div class="max-w-4xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6"><?= isset($blog) ? 'Edit Artikel' : 'Tambah Artikel Baru'; ?></h2>
    
    <form action="<?= isset($blog) ? base_url('portal/blog/update/' . $blog['id']) : base_url('portal/blog/save'); ?>" 
          method="post" enctype="multipart/form-data" class="bg-white p-8 border border-gray-200 shadow-sm">
        
        <?= csrf_field(); ?>
        
        <div class="mb-6">
            <label class="block font-semibold mb-2">Judul Artikel</label>
            <input type="text" name="judul" value="<?= $blog['judul'] ?? ''; ?>" class="w-full border p-3 rounded" required>
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-2">Thumbnail (Gambar Utama)</label>
            <?php if (isset($blog) && $blog['thumbnail']): ?>
                <div class="mb-2">
                    <img src="<?= base_url('uploads/blog/' . $blog['thumbnail']); ?>" class="w-32 h-32 object-cover rounded">
                </div>
            <?php endif; ?>
            <input type="file" name="thumbnail" accept="image/*" class="w-full border p-2 rounded">
            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar.</p>
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-2">Isi Artikel</label>
            <textarea id="editor" name="isi" class="w-full"><?= $blog['konten'] ?? ''; ?></textarea>
        </div>

        <div class="space-y-2">
            <label class="font-semibold text-gray-700">Tags (pisahkan dengan koma)</label>
            <input type="text" name="tags" 
                value="<?= isset($blogTags) ? implode(', ', array_column($blogTags, 'nama_tag')) : '' ?>" 
                class="w-full border p-3 rounded-lg" 
                placeholder="contoh: pendidikan, homeschooling, islami">
        </div>

        <button type="submit" class="bg-primary text-white px-8 py-3 font-bold rounded hover:bg-red-700 transition">
            <?= isset($blog) ? 'Update Artikel' : 'Simpan Artikel'; ?>
        </button>
    </form>
</div>
<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script src="https://cdn.tiny.cloud/1/[blmn2y0fhg4evn8d7g44ruq8no8krzhyzv16q7pezh1l9tkt]/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#editor',
        height: 400,
        // Pastikan plugin 'image' disertakan di sini
        plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist | image | help',
        
        // Konfigurasi agar bisa upload file
        automatic_uploads: true,
        file_picker_types: 'image',
        file_picker_callback: (callback, value, meta) => {
            if (meta.filetype === 'image') {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                
                input.onchange = function () {
                    const file = this.files[0];
                    const reader = new FileReader();
                    
                    // Kita gunakan FormData untuk mengirim ke controller upload
                    const formData = new FormData();
                    formData.append('file', file);
                    
                    fetch('<?= base_url('portal/upload/image'); ?>', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Mengirim URL gambar kembali ke TinyMCE
                        callback(data.location, { alt: file.name });
                    });
                };
                input.click();
            }
        }
    });
</script>
<?= $this->endSection(); ?>
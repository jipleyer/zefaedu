<?= $this->extend('layout/app'); ?>

<?= $this->section('content'); ?>
<article class="bg-white">
    <div class="relative w-full h-[60vh] overflow-hidden">
        <?php if ($blog['thumbnail']): ?>
            <img src="<?= base_url('uploads/blog/' . $blog['thumbnail']); ?>" 
                 alt="<?= esc($blog['judul']); ?>" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
        <?php endif; ?>
        
        <div class="absolute bottom-0 left-0 p-8 md:p-16 max-w-4xl text-white">
            <span class="inline-block px-3 py-1 bg-primary text-xs font-bold uppercase tracking-widest mb-4">Blog</span>
            <h1 class="text-3xl md:text-6xl font-extrabold leading-tight mb-4">
                <?= esc($blog['judul']); ?>
            </h1>
            <div class="flex items-center text-sm opacity-80">
                <span>Diterbitkan pada: <?= date('d F Y', strtotime($blog['created_at'])); ?></span>
            </div>
        </div>
    </div>

    <div class="max-w-3xl mx-auto py-16 px-6">
        <div class="prose prose-xl prose-slate max-w-none 
                    prose-headings:font-bold prose-headings:text-slate-900
                    prose-a:text-primary prose-a:no-underline hover:prose-a:underline
                    prose-img:rounded-xl prose-img:shadow-md">
            <?= $blog['konten']; ?>
        </div>
    </div>
</article>
<?= $this->endSection(); ?>
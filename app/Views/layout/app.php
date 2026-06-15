<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <title><?= $title ?? 'ZeFa International Islamic Homeschooling' ?></title>

  <meta name="description" content="<?= $description ?? 'ZeFa International Islamic Homeschooling - Shaping an Impactful, High-Character Generation.' ?>">
  <meta name="keywords" content="Homeschooling, Islamic Education, ZeFa, International School, Character Building">
  <meta name="author" content="ZeFa Education Ecosystem">
  <link rel="canonical" href="<?= current_url(); ?>">

  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= $title ?? 'ZeFa International Islamic Homeschooling' ?>">
  <meta property="og:description" content="<?= $description ?? 'Shaping an Impactful, High-Character Generation.' ?>">
  <meta property="og:image" content="<?= base_url('assets/images/og-thumbnail.jpg') ?>"> <meta property="og:url" content="<?= current_url(); ?>">
  <meta property="og:site_name" content="ZeFa Education">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= $title ?? 'ZeFa International Islamic Homeschooling' ?>">
  <meta name="twitter:description" content="<?= $description ?? 'Shaping an Impactful, High-Character Generation.' ?>">
  <meta name="twitter:image" content="<?= base_url('assets/images/og-thumbnail.jpg') ?>">

  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#ff3115',
            dark: '#111827',
            soft: '#f8fafc',
            line: '#e5e7eb'
          }
        }
      }
    }
  </script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    html{
      scroll-behavior: smooth;
    }
    body{
      font-family: 'Inter', sans-serif;
    }
  </style>

  <?= $this->renderSection('styles'); ?>
</head>

<body class="bg-white text-slate-800">

  <header class="sticky top-0 z-50 bg-white border-b border-line">
    <div class="max-w-7xl mx-auto px-6">
      <div class="flex items-center justify-between h-20">
        
        <div>
          <a href="<?= base_url('/'); ?>">
            <h1 class="text-2xl font-extrabold tracking-wide text-dark">
              ZE<span class="text-primary">FA</span>
            </h1>
          </a>
        </div>

        <nav class="hidden lg:flex items-center gap-10 text-sm font-semibold text-slate-700">
          <a href="#home" class="hover:text-primary transition">Home</a>
          <a href="#architecture" class="hover:text-primary transition">Architecture</a>
          <a href="#program" class="hover:text-primary transition">Programs</a>
          <a href="#admission" class="hover:text-primary transition">Admissions</a>
          <a href="#contact" class="hover:text-primary transition">Contact</a>
        </nav>

        <div class="flex items-center gap-4">
          <a href="https://wa.me/6281338384098" target="_blank" class="hidden lg:flex bg-primary hover:bg-red-700 transition text-white px-6 py-3 text-sm font-semibold">
            Initiate Partnership
          </a>
          <button id="menuBtn" class="lg:hidden flex flex-col gap-1.5">
            <span class="w-6 h-0.5 bg-dark"></span>
            <span class="w-6 h-0.5 bg-dark"></span>
            <span class="w-6 h-0.5 bg-dark"></span>
          </button>
        </div>

      </div>

      <div id="mobileMenu" class="hidden lg:hidden pb-6">
        <div class="flex flex-col border-t border-line pt-6 gap-5 text-sm font-semibold text-slate-700">
          <a href="#home" class="mobile-link hover:text-primary">Home</a>
          <a href="#architecture" class="mobile-link hover:text-primary">Architecture</a>
          <a href="#program" class="mobile-link hover:text-primary">Programs</a>
          <a href="#admission" class="mobile-link hover:text-primary">Admissions</a>
          <a href="#contact" class="mobile-link hover:text-primary">Contact</a>
        </div>
      </div>
    </div>

    <!-- ANNOUNCEMENT TOP BAR -->
    <?php 
    // Kita ambil model secara langsung di layout untuk memastikan data tersedia di semua halaman
    $pengumumanModel = new \App\Models\PengumumanModel();
    $announcement = $pengumumanModel->getActiveAnnouncement();
    ?>

    <?php if ($announcement): ?>
    <div id="announcementBar" class="bg-primary text-white text-xs md:text-sm font-semibold py-3 px-6 relative z-[60] transition-all duration-300">
        <div class="max-w-7xl mx-auto flex items-center justify-center text-center">
        <p>
            <span class="hidden md:inline-block mr-2 px-2 py-0.5 bg-white text-primary text-[10px] rounded-full uppercase tracking-wider">Info</span>
            <?= esc($announcement['isi_pengumuman']); ?>
            <a href="#contact" class="underline hover:text-gray-200 ml-1 transition">Pelajari Lebih Lanjut &rarr;</a>
        </p>
        
        <!-- Tombol Close -->
        <button onclick="document.getElementById('announcementBar').style.display='none'" class="absolute right-4 top-1/2 -translate-y-1/2 p-1 hover:bg-red-700 rounded transition" aria-label="Tutup Pengumuman">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        </div>
    </div>
    <?php endif; ?>
  </header>
    
  <main>
      <?= $this->renderSection('content'); ?>
  </main>

  <footer class="bg-black py-10">
    <div class="max-w-7xl mx-auto px-6 text-center text-slate-400 text-sm">
      <p class="mb-2 font-semibold text-white">ZEFA INTERNATIONAL ISLAMIC HOMESCHOOLING</p>
      <p class="mb-4">Shaping an Impactful, High-Character Generation.</p>
      <p>© 2026 ZeFa Education Ecosystem. All Rights Reserved.</p>
    </div>
  </footer>

  <script>
    // Logic untuk Burger Menu Mobile
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    if(menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Menutup menu mobile ketika salah satu tautan diklik
        const mobileLinks = document.querySelectorAll('.mobile-link');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
    }
  </script>
  
  <?= $this->renderSection('scripts'); ?>
</body>
</html>
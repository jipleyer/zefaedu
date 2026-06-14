<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal | ZeFa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#ff3115', // Menyelaraskan dengan warna utama web Anda
                        dark: '#111827'
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside id="sidebar" class="bg-slate-900 text-white w-64 min-h-screen fixed md:relative z-40 hidden md:block transition-all">
        <div class="p-6">
            <h1 class="text-xl font-bold text-primary">ZEFA PORTAL</h1>
        </div>
        <nav class="mt-6 px-4 space-y-2">
            <a href="/portal/dashboard" class="block py-2.5 px-4 rounded hover:bg-slate-800 transition">Dashboard</a>
            <a href="/portal/blog" class="block py-2.5 px-4 rounded hover:bg-slate-800 transition">Kelola Blog</a>
            <a href="/portal/pengumuman" class="block py-2.5 px-4 rounded hover:bg-slate-800 transition">Pengumuman</a>
            <hr class="border-slate-700 my-4">
            <a href="/login/logout" class="block py-2.5 px-4 rounded text-red-400 hover:bg-slate-800 transition">Logout</a>
        </nav>
    </aside>

    <!-- Content Area -->
    <div class="flex-1 flex flex-col">
        <header class="bg-white shadow-sm py-4 px-6 flex justify-between items-center">
            <button onclick="document.getElementById('sidebar').classList.toggle('hidden')" class="md:hidden p-2 bg-gray-200 rounded">
                Menu
            </button>
            <span class="font-semibold text-gray-700">Admin Area</span>
        </header>

        <main class="p-6">
            <?= $this->renderSection('content'); ?>
        </main>
    </div>

    <!-- PENTING: Section ini agar skrip TinyMCE atau skrip lain bisa dipanggil di sini -->
    <?= $this->renderSection('scripts'); ?>

</body>
</html>
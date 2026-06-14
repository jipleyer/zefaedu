<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BlogModel;

class Blog extends BaseController
{
    protected $blogModel;

    public function __construct()
    {
        $this->blogModel = new BlogModel();
    }

    // 1. Menampilkan daftar semua blog
    public function index()
    {
        $data['blogs'] = $this->blogModel->orderBy('created_at', 'DESC')->findAll();
        return view('admin/blog_index', $data);
    }

    public function show($slug)
    {
        $model = new \App\Models\BlogModel();
        $data['blog'] = $model->where('slug', $slug)->first();

        if (!$data['blog']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('blog_show', $data);
    }

    // 2. Menampilkan form tambah blog
    public function create()
    {
        return view('admin/blog_edit');
    }

    // 3. Menyimpan data baru
    public function save()
    {
        $file = $this->request->getFile('thumbnail');
        $thumbnailName = 'default.jpg';

        // Proses upload & konversi jika ada file yang dikirim
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $thumbnailName = $this->processAndSaveImage($file);
        }

        $data = [
            'judul'     => $this->request->getPost('judul'),
            'slug'      => url_title($this->request->getPost('judul'), '-', true),
            'konten'    => $this->request->getPost('isi'),
            'thumbnail' => $thumbnailName
        ];

        $this->blogModel->insert($data);
        return redirect()->to('/portal/blog')->with('success', 'Artikel berhasil diterbitkan!');
    }

    // Fungsi pembantu untuk resize dan convert ke WebP
    private function processAndSaveImage($file)
    {
        $newName = $file->getRandomName();
        $fileName = pathinfo($newName, PATHINFO_FILENAME);
        
        // Pastikan folder tujuan ada
        if (!is_dir('uploads/blog')) {
            mkdir('uploads/blog', 0777, true);
        }
        
        $image = \Config\Services::image()
            ->withFile($file)
            ->resize(1200, 800, true, 'width') // Resize lebar max 1200px
            ->convert(IMAGETYPE_WEBP)          // Konversi ke WebP
            ->save('uploads/blog/' . $fileName . '.webp', 80); // Kualitas 80%

        return $fileName . '.webp';
    }
    

    // 4. Menampilkan form edit
    public function edit($id)
    {
        $data['blog'] = $this->blogModel->find($id);
        return view('admin/blog_edit', $data);
    }

    // 5. Update data
    public function update($id)
    {
        // Ambil data lama dulu
        $blogLama = $this->blogModel->find($id);
        
        // Siapkan data dasar
        $data = [
            'judul'  => $this->request->getPost('judul'),
            'konten' => $this->request->getPost('isi'),
            'slug'   => url_title($this->request->getPost('judul'), '-', true)
        ];

        // Cek apakah ada file yang diupload
        $file = $this->request->getFile('thumbnail');
        
        // isValid() mengecek apakah file ada dan tidak error saat diupload
        if ($file && $file->isValid() && !$file->hasMoved()) {
            
            // 1. Hapus gambar lama jika bukan default.jpg
            if ($blogLama['thumbnail'] !== 'default.jpg' && file_exists('uploads/blog/' . $blogLama['thumbnail'])) {
                unlink('uploads/blog/' . $blogLama['thumbnail']);
            }
            
            // 2. Proses upload gambar baru (menggunakan fungsi yang kita buat tadi)
            $data['thumbnail'] = $this->processAndSaveImage($file);
        }

        // 3. Update ke database
        $this->blogModel->update($id, $data);
        
        return redirect()->to('/portal/blog')->with('success', 'Artikel berhasil diupdate!');
    }

    // 6. Hapus data
    public function delete($id)
    {
        // 1. Ambil data blog untuk mengetahui nama file gambarnya
        $blog = $this->blogModel->find($id);

        if ($blog) {
            // 2. Cek apakah ada file gambar dan bukan gambar default
            if ($blog['thumbnail'] !== 'default.jpg' && file_exists('uploads/blog/' . $blog['thumbnail'])) {
                // 3. Hapus file fisik dari storage
                unlink('uploads/blog/' . $blog['thumbnail']);
            }

            // 4. Baru hapus record di database
            $this->blogModel->delete($id);
        }

        return redirect()->to('/portal/blog')->with('success', 'Artikel dan gambar berhasil dihapus.');
    }
}
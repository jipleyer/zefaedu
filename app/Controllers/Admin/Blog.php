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

    public function index()
    {
        $data['blogs'] = $this->blogModel->orderBy('created_at', 'DESC')->findAll();
        return view('admin/blog_index', $data);
    }

    public function create()
    {
        $db = \Config\Database::connect();
        $data['allTags'] = $db->table('tags')->get()->getResultArray();
        $data['currentTags'] = [];
        return view('admin/blog_edit', $data);
    }

    public function save()
    {
        $file = $this->request->getFile('thumbnail');
        $thumbnailName = 'default.jpg';

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $thumbnailName = $this->processAndSaveImage($file);
        }

        $data = [
            'judul'     => $this->request->getPost('judul'),
            'slug'      => url_title($this->request->getPost('judul'), '-', true),
            'konten'    => $this->request->getPost('isi'),
            'excerpt'   => $this->request->getPost('excerpt'),
            'thumbnail' => $thumbnailName,
            'created_at'=> date('Y-m-d H:i:s')
        ];

        $this->blogModel->insert($data);
        $blogId = $this->blogModel->getInsertID();

        // Panggil fungsi sinkronisasi tag
        $this->syncTags($blogId, $this->request->getPost('tags'));

        return redirect()->to('/portal/blog')->with('success', 'Artikel berhasil diterbitkan!');
    }

    public function update($id)
    {
        $blogLama = $this->blogModel->find($id);
        
        $data = [
            'judul'   => $this->request->getPost('judul'),
            'konten'  => $this->request->getPost('isi'),
            'excerpt' => $this->request->getPost('excerpt'),
            'slug'    => url_title($this->request->getPost('judul'), '-', true),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $file = $this->request->getFile('thumbnail');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if ($blogLama['thumbnail'] !== 'default.jpg' && file_exists('uploads/blog/' . $blogLama['thumbnail'])) {
                unlink('uploads/blog/' . $blogLama['thumbnail']);
            }
            $data['thumbnail'] = $this->processAndSaveImage($file);
        }

        $this->blogModel->update($id, $data);

        // Panggil fungsi sinkronisasi tag (otomatis menghapus yang lama dan memasang yang baru)
        $this->syncTags($id, $this->request->getPost('tags'));
        
        return redirect()->to('/portal/blog')->with('success', 'Artikel berhasil diupdate!');
    }

    /**
     * Fungsi untuk sinkronisasi tag (Create if not exist & Sync)
     */
    private function syncTags($blogId, $tagsInput)
    {
        $db = \Config\Database::connect();
        
        // 1. Hapus relasi lama
        $db->table('blog_tags')->where('blog_id', $blogId)->delete();

        // 2. Jika input kosong, berhenti di sini
        if (empty(trim($tagsInput))) return;

        // 3. Pecah string berdasarkan koma
        $tagsArray = array_map('trim', explode(',', $tagsInput));

        foreach ($tagsArray as $tagName) {
            if (empty($tagName)) continue;

            $slug = url_title($tagName, '-', true);

            // 4. Cari tag, jika tidak ada, buat baru
            $tag = $db->table('tags')->where('slug', $slug)->get()->getRowArray();

            if (!$tag) {
                $db->table('tags')->insert(['nama_tag' => $tagName, 'slug' => $slug]);
                $tagId = $db->insertID();
            } else {
                $tagId = $tag['id'];
            }

            // 5. Masukkan ke tabel pivot
            $db->table('blog_tags')->insert(['blog_id' => $blogId, 'tag_id' => $tagId]);
        }
    }

    public function edit($id)
    {
        $data['blog'] = $this->blogModel->find($id);
        
        if (!$data['blog']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $db = \Config\Database::connect();
        
        // Kita ambil nama-nama tag yang terhubung dengan blog ini
        $data['blogTags'] = $db->table('tags')
                            ->join('blog_tags', 'tags.id = blog_tags.tag_id')
                            ->where('blog_tags.blog_id', $id)
                            ->get()
                            ->getResultArray();
        
        return view('admin/blog_edit', $data);
    }

    private function processAndSaveImage($file)
    {
        $newName = $file->getRandomName();
        $fileName = pathinfo($newName, PATHINFO_FILENAME);
        
        if (!is_dir('uploads/blog')) {
            mkdir('uploads/blog', 0777, true);
        }
        
        \Config\Services::image()
            ->withFile($file)
            ->resize(1200, 800, true, 'width')
            ->convert(IMAGETYPE_WEBP)
            ->save('uploads/blog/' . $fileName . '.webp', 80);

        return $fileName . '.webp';
    }


    public function delete($id)
    {
        $blog = $this->blogModel->find($id);
        if ($blog) {
            if ($blog['thumbnail'] !== 'default.jpg' && file_exists('uploads/blog/' . $blog['thumbnail'])) {
                unlink('uploads/blog/' . $blog['thumbnail']);
            }
            $db = \Config\Database::connect();
            $db->table('blog_tags')->where('blog_id', $id)->delete();
            $this->blogModel->delete($id);
        }
        return redirect()->to('/portal/blog')->with('success', 'Artikel berhasil dihapus.');
    }
}
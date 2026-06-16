<?php

namespace App\Controllers;

use App\Models\BlogModel;

class Blog extends BaseController
{
    /**
     * Menampilkan satu artikel berdasarkan slug
     */
    public function show($slug = null)
    {
        $model = new BlogModel();
        $db = \Config\Database::connect();
        
        // 1. Cari artikel berdasarkan slug
        $data['blog'] = $model->where('slug', $slug)->first();

        // 2. Jika artikel tidak ditemukan, tampilkan error 404
        if (empty($data['blog'])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // 3. Ambil tag yang terkait dengan blog ini
        $data['tags'] = $db->table('tags')
                           ->join('blog_tags', 'tags.id = blog_tags.tag_id')
                           ->where('blog_tags.blog_id', $data['blog']['id'])
                           ->get()
                           ->getResultArray();

        // 4. Kirim data ke view dengan array untuk SEO
        // Variabel ini akan ditangkap oleh view untuk mengisi meta tag
        return view('blog_show', [
            'blog'        => $data['blog'],
            'tags'        => $data['tags'],
            'title'       => $data['blog']['judul'], // Untuk SEO Title
            'description' => $data['blog']['excerpt'] // Untuk Meta Description
        ]);
    }
}
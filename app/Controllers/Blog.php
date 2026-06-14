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
        
        // Cari artikel berdasarkan slug
        $data['blog'] = $model->where('slug', $slug)->first();

        // Jika artikel tidak ditemukan, tampilkan error 404
        if (empty($data['blog'])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('blog_show', $data);
    }
}
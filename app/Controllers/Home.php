<?php

namespace App\Controllers;

use App\Models\BlogModel;

class Home extends BaseController
{
    public function index()
    {
        $blogModel = new \App\Models\BlogModel();
        $pengumumanModel = new \App\Models\PengumumanModel();

        $data = [
            'posts' => $blogModel->orderBy('created_at', 'DESC')->findAll(),
            'announcement' => $pengumumanModel->getActiveAnnouncement()
        ];

        return view('home', $data);
    }
}

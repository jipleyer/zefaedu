<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengumumanModel;

class Pengumuman extends BaseController
{
    public function index()
    {
        $model = new PengumumanModel();
        $data['pengumuman'] = $model->findAll();
        return view('admin/pengumuman', $data); // Buat view di app/Views/admin/
    }

    public function update()
    {
        $model = new \App\Models\PengumumanModel();
        $id = $this->request->getPost('id');
        
        $model->update($id, [
            'isi_pengumuman' => $this->request->getPost('isi'),
            'is_active'      => $this->request->getPost('status') ? 1 : 0
        ]);

        // PASTIKAN REDIRECT MENGARAH KE 'portal/pengumuman'
        return redirect()->to('/portal/pengumuman')->with('msg', 'Berhasil diupdate');
    }
}
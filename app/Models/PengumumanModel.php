<?php

namespace App\Models;

use CodeIgniter\Model;

class PengumumanModel extends Model
{
    protected $table            = 'pengumuman';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['isi_pengumuman', 'is_active', 'updated_at'];

    // Fungsi untuk mengambil hanya pengumuman yang sedang aktif
    public function getActiveAnnouncement()
    {
        return $this->where('is_active', 1)->first();
    }
}
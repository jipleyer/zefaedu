<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PengumumanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'isi_pengumuman' => 'Pendaftaran Siswa Baru Angkatan Ke-2 Telah Dibuka! Segera amankan kuota Anda.',
            'is_active'      => true,
            'created_at'     => date('Y-m-d H:i:s'),
        ];
        $this->db->table('pengumuman')->insert($data);
    }
}
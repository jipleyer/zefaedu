<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'judul'     => 'Mengapa Kami Memilih Essentialism?',
                'slug'      => 'mengapa-kami-memilih-essentialism',
                'konten'    => 'Di dunia yang penuh kebisingan, ZeFa memilih untuk fokus pada hal-hal yang memiliki daya ungkit terbesar.',
                'thumbnail' => 'default.jpg',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'judul'     => 'Strategi ZeFa dalam Membangun Karakter',
                'slug'      => 'strategi-zefa-membangun-karakter',
                'konten'    => 'Karakter tidak dibentuk melalui ceramah, melainkan melalui ekosistem yang konsisten.',
                'thumbnail' => 'default.jpg',
                'created_at' => date('Y-m-d H:i:s'),
            ]
        ];
        $this->db->table('blog')->insertBatch($data);
    }
}
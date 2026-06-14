<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    protected $table            = 'blog';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['judul', 'slug', 'konten', 'thumbnail', 'created_at'];

    // Menggunakan timestamps otomatis jika Anda menggunakan field created_at/updated_at
    protected $useTimestamps = true; 
}
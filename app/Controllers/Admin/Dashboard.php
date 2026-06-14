<?php

namespace App\Controllers\Admin; // Perhatikan namespace ini!

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('admin/dashboard');
    }
}
<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    // Method ini yang dipanggil oleh route 'login-rahasia'
    public function index()
    {
        return view('admin/login');
    }

    // Method ini yang dipanggil saat tombol login ditekan
    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $db = \Config\Database::connect();
        $user = $db->table('users')->where('username', $username)->get()->getRowArray();

        if ($user && password_verify($password, $user['password'])) {
            session()->set('isLoggedIn', true);
            return redirect()->to('/portal/dashboard'); // Arahkan ke /portal/dashboard
        }

        return redirect()->back()->with('error', 'Username atau Password salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
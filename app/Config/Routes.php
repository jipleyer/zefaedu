<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// 1. Landing Page Publik
$routes->get('/', 'Home::index');

// Route Publik Blog (Ditaruh di luar group portal)
$routes->get('blog/(:segment)', 'Blog::show/$1');

// 2. Auth (Login & Logout)
$routes->get('login', 'Admin\Auth::index');
$routes->post('login/auth', 'Admin\Auth::login');
$routes->get('login/logout', 'Admin\Auth::logout');

// 3. Portal Admin (Hanya untuk Admin)
$routes->group('portal', ['filter' => 'adminAuth'], function($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    
    // Blog (CRUD Admin)
    $routes->get('blog', 'Admin\Blog::index');
    $routes->get('blog/create', 'Admin\Blog::create');
    $routes->post('blog/save', 'Admin\Blog::save');
    $routes->get('blog/edit/(:num)', 'Admin\Blog::edit/$1');
    $routes->post('blog/update/(:num)', 'Admin\Blog::update/$1');
    $routes->get('blog/delete/(:num)', 'Admin\Blog::delete/$1');
    $routes->post('upload/image', 'Admin\Upload::image');
    
    // Pengumuman
    $routes->get('pengumuman', 'Admin\Pengumuman::index');
    $routes->post('pengumuman/update', 'Admin\Pengumuman::update');
});
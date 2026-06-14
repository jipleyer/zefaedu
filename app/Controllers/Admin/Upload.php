<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class Upload extends BaseController {
    public function image() {
        $file = $this->request->getFile('file'); // 'file' adalah nama yang kita append di JS
        if ($file && $file->isValid()) {
            $newName = $file->getRandomName();
            $file->move('uploads/blog', $newName);
            return $this->response->setJSON(['location' => base_url('uploads/blog/' . $newName)]);
        }
    }
}
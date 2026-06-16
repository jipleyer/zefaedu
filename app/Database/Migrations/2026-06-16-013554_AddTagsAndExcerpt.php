<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTagsAndExcerpt extends Migration
{
    public function up()
    {
        // 1. Tambahkan kolom excerpt ke tabel blog
        $this->forge->addColumn('blog', [
            'excerpt' => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true, 'after' => 'konten'],
        ]);

        // 2. Buat tabel tags
        $this->forge->addField([
            'id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_tag' => ['type' => 'VARCHAR', 'constraint' => '100'],
            'slug'     => ['type' => 'VARCHAR', 'constraint' => '100', 'unique' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tags');

        // 3. Buat tabel pivot blog_tags (Many-to-Many)
        $this->forge->addField([
            'blog_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tag_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
        ]);
        $this->forge->addForeignKey('blog_id', 'blog', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('tag_id', 'tags', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('blog_tags');
    }

    public function down()
    {
        $this->forge->dropTable('blog_tags');
        $this->forge->dropTable('tags');
        $this->forge->dropColumn('blog', 'excerpt');
    }
}
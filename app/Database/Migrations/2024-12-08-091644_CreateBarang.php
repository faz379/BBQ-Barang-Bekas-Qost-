<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'barang_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'kategori' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'image_path' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'nama_barang' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
            ],
            'harga' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
           'status' => [
            'type' => 'VARCHAR',
            'constraint' => 20,
           ],
           'kontak' => [
            'type' => 'VARCHAR',
            'constraint' => 20,
           ],
           'created_at' => [
            'type' => 'DATETIME',
            'null' => true,
           ],
            'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
           ],
        ]);
        $this->forge->addKey('barang_id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'SET NULL', 'SET NULL');
        $this->forge->addForeignKey('category_id', 'categories', 'category_id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('barang');

    }

    public function down()
    {
        $this->forge->dropTable('barang');
    }
}

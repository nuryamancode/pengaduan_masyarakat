<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DataUji extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false,
            ],
            'id_pengaduan' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false,
            ],
            'nilai' => [
                'type' => 'DOUBLE',
                'null' => true,
            ],
            'kategori' => [
                'type' => 'ENUM',
                'constraint' => ['Kekerasan', 'Penipuan', 'Pencurian'],
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE', 'fk_id_user');
        $this->forge->addForeignKey('id_pengaduan', 'pengaduan', 'id', 'CASCADE', 'CASCADE', 'fk_id_pengaduan');
        $this->forge->createTable('data_uji');
    }

    public function down()
    {
        $this->forge->dropForeignKey('data_uji', 'fk_id_user');
        $this->forge->dropForeignKey('data_uji', 'fk_id_pengaduan');
        $this->forge->dropTable('data_uji');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tindakan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'keterangan' => [
                'type'       => 'LONGTEXT',
                'null'       => true,
            ],
            'lampiran' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'id_pengaduan' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
                'null'       => false,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
                'null'       => false,
            ],
        ]);

        // Menambahkan primary key
        $this->forge->addKey('id', true);

        // Menambahkan foreign keys dengan nama yang spesifik
        $this->forge->addForeignKey('id_pengaduan', 'pengaduan', 'id', 'CASCADE', 'CASCADE', 'fk_tindakan_id_pengaduan');
        $this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE', 'fk_tindakan_id_user');

        // Membuat tabel
        $this->forge->createTable('tindakan');
    }

    public function down()
    {
        // Menghapus foreign keys dengan nama yang spesifik
        $this->forge->dropForeignKey('tindakan', 'fk_tindakan_id_pengaduan');
        $this->forge->dropForeignKey('tindakan', 'fk_tindakan_id_user');

        // Menghapus tabel
        $this->forge->dropTable('tindakan');
    }
}

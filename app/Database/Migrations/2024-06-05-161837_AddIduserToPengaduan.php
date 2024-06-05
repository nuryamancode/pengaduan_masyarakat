<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIduserToPengaduan extends Migration
{
    public function up()
    {
        // Menambahkan kolom id_user
        $this->forge->addColumn('pengaduan', [
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false,
                'after'          => 'id', // Menambahkan field setelah kolom 'id'
            ],
        ]);

        // Menambahkan foreign key pada kolom id_user
        $this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE', 'id_user_fk');

        // Memproses indeks dan kunci
        $this->forge->processIndexes('pengaduan');
    }

    public function down()
    {
        // Menghapus foreign key dan kolom id_user
        $this->forge->dropForeignKey('pengaduan', 'id_user_fk');
        $this->forge->dropColumn('pengaduan', 'id_user');
    }
}

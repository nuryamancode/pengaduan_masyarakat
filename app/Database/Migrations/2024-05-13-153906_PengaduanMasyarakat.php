<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PengaduanMasyarakat extends Migration
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
            'deksripsi' => [
                'type'       => 'LONGTEXT',
                'null'=> true,
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'null' => true,
            ],
        ]);
        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('pengaduan');
    }

    public function down()
    {
        $this->forge->dropTable('pengaduan');
    }
}

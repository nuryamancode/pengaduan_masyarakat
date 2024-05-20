<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Datalatih extends Migration
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
            'nilai' => [
                'type'       => 'DOUBLE',
                'null' => true,
            ],
            'kategori' => [
                'type'       => 'ENUM',
                'constaint' => ['Kekerasan', 'Penipuan', 'Pencurian'],
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('data_latih');
    }

    public function down()
    {
        $this->forge->dropTable('data_latih');
        
    }
}

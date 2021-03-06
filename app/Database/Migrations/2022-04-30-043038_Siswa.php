<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Siswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'nama'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'created_at' => [
                'type'  => 'DATETIME',
                'null'  => 'true' //boleh null 
            ],
            'updated_at' => [
                'type'  => 'DATETIME',
                'null'  => 'true'
            ]
        ]);
        $this->forge->addKey('id', true); //primery key 
        $this->forge->createTable('siswa'); //nama table
    }

    public function down()
    {
        $this->forge->dropTable('siswa');
    }
}

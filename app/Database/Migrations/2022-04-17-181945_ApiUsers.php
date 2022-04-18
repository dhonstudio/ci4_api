<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ApiUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
            ],
            'password' => [
                'type'          => 'VARCHAR',
                'constraint'    => '200',
            ],
            'created_at' => [
                'type'  => 'DATETIME',
                'null'  => TRUE
            ],
            'updated_at' => [
                'type'  => 'DATETIME',
                'null'  => TRUE
            ]
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('api_users');
    }

    public function down()
    {
        $this->forge->dropTable('api_users');
    }
}

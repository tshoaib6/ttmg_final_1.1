<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Clientele extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 30,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'phone_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 12,
                'null' => true,
            ],
            'state' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'default' => 0,
            ],
            'address' => [
                'type'       => 'VARCHAR',
                'constraint' => 140,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('clientele');
    }

    public function down()
    {
        //
    }
}

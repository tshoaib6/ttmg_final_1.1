<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EmailTemplate extends Migration
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
            'subject' => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
            ],
            'message' => [
                'type' => 'TEXT',
            ],
            'user' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'event' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('emailtemplate');
    }

    public function down()
    {
        $this->forge->dropTable('emailtemplate');
    }
}

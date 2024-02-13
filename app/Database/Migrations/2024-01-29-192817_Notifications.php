<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Notifications extends Migration
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
            'isread' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'description' => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'from_user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'from_full_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'to_user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'link' => [
                'type'       => 'TEXT',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('notifications');
    }

    public function down()
    {
        $this->forge->dropTable('notifications');
    }
}

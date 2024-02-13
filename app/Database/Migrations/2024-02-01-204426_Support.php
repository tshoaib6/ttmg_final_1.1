<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Support extends Migration
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
            'request_type' => [
                'type'       => 'varchar',
                'constraint' => '300',
                'null' => true,
            ],
            'message' => [
                'type'       => 'LONGTEXT',
            ],
            'viewed' =>[
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'viewed_by_admin' =>[
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'sender_id' =>[
                'type' => 'INT',
                'constraint' => 30,
            ],
            'receiver_id' =>[
                'type' => 'INT',
                'constraint' => 30,
            ],
            'sender_full_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('support');
    }

    public function down()
    {
        $this->forge->dropTable('support');
    }
}

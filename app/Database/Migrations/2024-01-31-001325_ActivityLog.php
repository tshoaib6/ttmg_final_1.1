<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ActivityLog extends Migration
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
            'description' => [
                'type'       => 'TEXT',
                'null' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'full_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('activitylog');
    }

    public function down()
    {
       $this->forge->dropTable('activitylog');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Remainders extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'lead_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'client_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'flag' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'remainder_text' => [
                'type' => 'TEXT',
            ],
            'remainder_title' => [
                'type' => 'TEXT',
            ],
            'remainder_time_date' => [
                'type' => 'DATETIME',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('remainders');
    }

    public function down()
    {
        $this->forge->dropTable('remainders');
    }
}

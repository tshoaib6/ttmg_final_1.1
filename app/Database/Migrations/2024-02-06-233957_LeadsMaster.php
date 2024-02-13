<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Leads_master extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'phone_number' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'agent_name' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'camp_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'firstname' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'lastname' => [
                'type' => 'VARCHAR',
                'constraint' => 2000,
            ],
            'state' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'complete_lead' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'order_id' => [
                'type' => 'INT',
                'constraint' => 10,
            ],

            'status' => [
                'type' => 'BOOLEAN',
            ],
            'master_search' => [
                'type' => 'LONGTEXT',
                 
            ],
            'is_delete' => [
                'type' => 'BOOLEAN',
            ],
            'is_import' => [
                'type' => 'BOOLEAN',
            ],
            'reject_reason' => [
                'type' => 'TEXT',
            ],
            'reject_date' => [
                'type' => 'date',
            ],
            'client_id' => [
                'type' => 'INT',
            ],
            'vendor_id' => [
                'type' => 'INT',
            ],
            
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('leads_master');
    }

    public function down()
    {
        //
    }
}

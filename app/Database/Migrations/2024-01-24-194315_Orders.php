<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Orders extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'pkorderid' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'state' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            
            'categoryname' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'prioritylevel' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'notes' => [
                'type' => 'VARCHAR',
                'constraint' => 2000,
            ],
            'agent' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'ageranges' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
            ],
            'userassignid' => [
                'type' => 'INT',
                'constraint' => 10,
            ],
            'vend' => [
                'type' => 'VARCHAR',
                'constraint' => 101,
            ],
            'orderdate' => [
                'type' => 'TEXT',
            ],
            'lead_requested' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'remainingLeads' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'replacementLeads' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            
            'fkadminstaffid' => [
                'type' => 'INT',
                'constraint' => 10,
            ],
            'fkclientid' => [
                'type' => 'INT',
                'constraint' => 10,
            ],
            'fkvendorstaffid' => [
                'type' => 'INT',
                'constraint' => 10,
            ],
            
            'block' => [
                'type' => 'BOOLEAN',
            ],
        ]);

        $this->forge->addPrimaryKey('pkorderid');
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}

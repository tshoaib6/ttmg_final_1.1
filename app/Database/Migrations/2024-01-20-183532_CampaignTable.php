<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CampaignTable extends Migration
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
            'campaign_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'campaign_columns' => [
                'type'       => 'TEXT',
                'constraint' => '',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('campaign');
    }

    public function down()
    {
        $this->forge->dropTable('campaign');

    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Referral extends Migration
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
            'full_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '300',
                'null' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 30,
                'default' => 0,
            ],
            'vendor_id' => [
                'type'       => 'INT',
                'constraint' => 30,
            ],
            'token' => [
                'type'       => 'text',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('referral');
    }

    public function down()
    {
        $this->forge->dropTable('referral');
    }
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Authentication extends Migration
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
            'firstname' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'lastname' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'email' => [
                'type' => 'TEXT',
            ],
            'password' => [
                'type' => 'TEXT',
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'address' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'website' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'coverage' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'linkedin' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'useruimage' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'vendor' => [
                'type'           => 'VARCHAR',
                'constraint'     => '300',
            ],
            'userrole' => [
                'type' => 'INT',
                'constraint' => 10,
            ],
            'smtpemail' => [
                'type'       => 'VARCHAR',
                'constraint' => '300',
                'null' => true,
            ],
            'smtppassword' => [
                'type'       => 'VARCHAR',
                'constraint' => '300',
                'null' => true,
            ],
            'smtpincomingserver' => [
                'type'       => 'VARCHAR',
                'constraint' => '300',
                'null' => true,
            ],
            'smtpoutgoingserver' => [
                'type'       => 'VARCHAR',
                'constraint' => '300',
                'null' => true,
            ],
            'smtpport' => [
                'type'       => 'VARCHAR',
                'constraint' => '300',
                'null' => true,
            ],
            'branchname' => [
                'type'       => 'VARCHAR',
                'constraint' => '300',
                'null' => true,
            ],
            'branchslug' => [
                'type'       => 'VARCHAR',
                'constraint' => '300',
                'null' => true,
            ],
            'branchcountry' => [
                'type'       => 'VARCHAR',
                'constraint' => '300',
                'null' => true,
            ],
            'branchaddress' => [
                'type'       => 'VARCHAR',
                'constraint' => '300',
                'null' => true,
            ],
            'brancheader' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'branchnavbar' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'branchnavtext' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'branchnavhover' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'branchlogo' => [
                'type'       => 'VARCHAR',
                'constraint' => '300',
                'null' => true,
            ],
            'branchlogoheight' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'branchlogowidth' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'block' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
            ],
            'referred_to' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
                'null' => true,
            ],
            'last_login datetime default NULL ',
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp'
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}

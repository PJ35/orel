<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Session extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'day' => [
                'type' => 'TINYINT',
            ],
            'start' => [
                'type' => 'TIME',
            ],
            'end' => [
                'type' => 'TIME',
            ],
            'first' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'section_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('section_id', 'section', 'id');
        $this->forge->createTable('session');
    }

    public function down()
    {
        $this->forge->dropTable('session');
    }
}

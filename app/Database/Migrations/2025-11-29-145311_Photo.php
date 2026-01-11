<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Photo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'path' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'featured' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'article_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('article_id', 'article', 'id');
        $this->forge->createTable('photo');
    }

    public function down()
    {
        $this->forge->dropTable('photo');
    }
}

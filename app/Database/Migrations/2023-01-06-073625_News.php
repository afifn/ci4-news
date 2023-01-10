<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class News extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'auto_increment' => true
			],
			'id_category' => [
				'type' => 'INT',
				'constraint' => 5,
				'null' => true
			],
			'title'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'author'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 100,
				'default'        => 'John Doe',
			],
			'content' => [
				'type'           => 'TEXT',
				'null'           => true,
			],
			'slug' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('news');
	}

	public function down()
	{
		//
	}
}

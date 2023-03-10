<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Category extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'contraint' => 5,
				'unsigned' => true,
				'auto_increment' => true
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'slug' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('category');
	}

	public function down()
	{
		//
	}
}

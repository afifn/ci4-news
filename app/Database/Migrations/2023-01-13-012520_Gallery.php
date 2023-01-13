<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Gallery extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_gallery' => [
				'type' => 'BIGINT',
				'constraint' => 11,
				'unsigned' => true,
				'auto_increment' => true
			],
			'title' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'created_at' => [
				'type' => 'DATE',
			]
		]);
		$this->forge->addKey('id_gallery', true);
		$this->forge->createTable('gallery');
	}

	public function down()
	{
		$this->forge->dropTable('gallery');
	}
}

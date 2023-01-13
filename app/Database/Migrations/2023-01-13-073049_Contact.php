<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Contact extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_contact' => [
				'type' => 'BIGINT',
				'constraint' => 11,
				'unsigned' => true,
				'auto_increment' => true
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => 60,
			],
			'message' => [
				'type' => 'TEXT'
			]
		]);
		$this->forge->addKey('id_contact', true);
		$this->forge->createTable('contacts');
	}

	public function down()
	{
		$this->forge->createTable('contacts');
	}
}

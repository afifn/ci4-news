<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Setting extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_setting' => [
				'type' => 'INT',
				'constraint' => 1,
				'unsigned' => true,
				'auto_increment'
			],
			'title' => [
				'type' => 'VARCHAR',
				'constraint' => 30
			],
			'about' => [
				'type' => 'TEXT',
				'null' => true
			],
			'logo' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => true
			],
			'favicon' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => true
			],
		]);
		$this->forge->addKey('id_setting', true);
		$this->forge->createTable('setting');
	}

	public function down()
	{
		$this->forge->dropTable('setting');
	}
}

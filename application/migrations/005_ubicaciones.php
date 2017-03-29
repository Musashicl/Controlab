<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* This basic migration has been auto-generated by the Gas ORM */

class Migration_ubicaciones extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
			),
			'ubicacion' => array(
				'type' => 'VARCHAR',
				'constraint' => 45,
			),
		));

		$this->dbforge->add_key('id', TRUE);

		$this->dbforge->create_table('ubicaciones', TRUE);
	}

	public function down()
	{
		$this->dbforge->drop_table('ubicaciones');
	}
}
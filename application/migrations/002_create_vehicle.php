<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_vehicle extends CI_Migration{

    public function up(){
        $this->dbforge->add_field(array(
            'licensePlate' => array(
                'type' => ' VARCHAR',
                'constraint' => '6',
                'unsigned' => TRUE,
            ),
            'type' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => FALSE,
            ),
            'color' => array(
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => FALSE,
            ),
        ));
        $this->dbforge->add_key('licensePlate', TRUE);
        $this->dbforge->create_table('vehicle');

    }

    public function down(){
         $this->dbforge->drop_table('vehicle');
    }
}


?>
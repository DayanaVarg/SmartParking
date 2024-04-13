<?php
 defined('BASEPATH') OR exit('No direct script access allowed');

 class Migration_create_activityDetails extends CI_Migration{

    public function up(){
        $this->dbforge->add_field(array(
            'idDetails' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'date_Entrance' => array(
                'type' => 'DATE',
                'null' => FALSE,
            ),
            'time_Entrance' => array(
                'type' => 'TIME',
                'null' => FALSE,
            ),
            'date_Finish' => array(
                'type' => 'DATE',
                'null' => TRUE,
            ),
            'time_Finish' => array(
                'type' => 'TIME',
                'null' => TRUE,
            ),
            'totalCost' => array(
                'type' => 'INT',
                'constraint' => '15',
                'null' => TRUE,
            ),
            'FK_licensePlate' => array(
                'type' => 'VARCHAR',
                'constraint' => '6',
                'null' => FALSE,
                'unsigned' => TRUE,
            ),

        ));
        $this->dbforge->add_key('idDetails', TRUE);
        $this->dbforge->create_table('activityDetails');

        $this->db->query('ALTER TABLE activityDetails ADD CONSTRAINT fk_vehicle_dateils FOREIGN KEY (FK_licensePlate) REFERENCES vehicle(licensePlate) ON DELETE CASCADE ON UPDATE CASCADE');

    }

    public function down(){
        $this->dbforge->drop_table('activityDetails');
    }
}

?>
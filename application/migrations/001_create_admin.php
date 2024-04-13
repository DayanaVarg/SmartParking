<?php

defined('BASEPATH') or exit('No direct script acces allowed');

class Migration_create_admin extends CI_Migration {

    public function up(){

        $this->dbforge->add_field(array(
            'identification' =>array(
                'type'=> 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint'=> '40',
                'null' => FALSE,
            ),
            'lastname' => array(
                'type'=>'VARCHAR',
                'constraint'=>'40',
                'null' => FALSE,
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => FALSE,

            ),
            'email' => array(
                'type' =>'VARCHAR',
                'constraint' => '60',
                'null' => FALSE,
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
            ),
        ));
        $this->dbforge->add_key('identification', TRUE);
        $this->dbforge->create_table('admin');
    }

    public function down(){
        $this->dbforge->drop_table('admin');
    }
}

?>
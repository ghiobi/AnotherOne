<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_users extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id' => array(
                                'type' => 'INT',
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'login_id' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '32',
                        ),
                        'password' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '256',
                        ),
                        'firstname' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '64',
                        ),
                        'lastname' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '64',
                        ),
                        'admin' => array(
                                'type' => 'TINYINT',
                                'constraint' => '1',
                        ),
                ));
                $this->dbforge->add_key('id', TRUE);
                $this->dbforge->create_table('users');
        }

        public function down()
        {
                $this->dbforge->drop_table('users');
        }
}
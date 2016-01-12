<?php defined("BASEPATH") or exit("No direct script access allowed");

class Migrate extends CI_Controller{

    public function index()
    {
        $this->load->library("migration");
        log_message('debug', $this->migration->current());
    }
}

?>
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logout extends MY_Auth {

    public function __construct() {
        CI_Controller::__construct();
        $this->load->driver('cache');
        $this->cache->clean();
        $this->load->helper('url');
        $this->load->helper('language');
    }

    public function index() {
        $this->logout();
    }

}

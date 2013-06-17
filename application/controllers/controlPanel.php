<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ControlPanel extends MY_Auth {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        //loading the template
        $this->tpl();
        $data['pageTitle'] = $this->pageTitle; //Assign page title
        $data['container'] = 'modules/controlpanel/index'; //Assign page content
        $this->load->view('index', $data); //Loading default view
    }

    protected function tpl() {
        $this->pageTitle = 'Controle Panel'; //Page title
        return;
    }

}

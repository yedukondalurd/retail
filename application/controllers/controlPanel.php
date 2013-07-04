<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ControlPanel extends MY_Auth {

    public function __construct() {
        parent::__construct();
        $this->load->model('Access_model'); //Loading access model
    }

    public function index() {
        //Loading Main menu links
        $menuLinks = $this->Access_model->mainMenuLinks($this->current_user[0]['id']);
        $data['menuLinks'] = $menuLinks;
        //loading the template
        $this->tpl();
        $data['pageTitle'] = $this->pageTitle; //Assign page title
        $data['container'] = 'modules/controlpanel/index'; //Assign page content
        $this->load->view('index', $data); //Loading default view
    }

    protected function tpl() {
        $pageTitle = 'Control Panel'; //Page title
        return array('pageTitle' => $pageTitle);
    }

}

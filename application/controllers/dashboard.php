<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends MY_Auth {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        //Loading Main menu links
        $menuLinks = $this->Access_model->mainMenuLinks($this->current_user[0]['id']);
        $data['menuLinks'] = $menuLinks;
        //loading the template
        $tpl = $this->tpl();
        $data['pageTitle'] = $tpl['pageTitle']; //Assign page title
        $data['container'] = 'modules/dashboard/index'; //Assign page content
        $this->load->view('index', $data); //Loading default view
    }

    protected function tpl() {
        $pageTitle = 'Dashboard'; //Page title
        return array('pageTitle' => $pageTitle);
    }

}

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Auth extends CI_Controller {

    protected $current_user;
    protected $pageTitle;

    public function __construct() {
        parent::__construct();
        $this->load->driver('cache');
        $this->cache->clean();
        $this->load->helper('url');
        $this->load->helper('language');
        $this->checkLogin();
    }

    public function checkLogin() {
        //Clearing cache to not showing back page when login or logout....
        header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->current_user = $this->session->userdata('user'); //Assigning session value to user property
        if (empty($this->current_user)) {
            $this->setLogin();
        } else {
            $this->moduleAccess($this->current_user);
            //checking wether the controller is login or others.
            //if it is login then it will automatically redirect to dashboard.
            if ($this->uri->segment(1) == 'login') {
                redirect('dashboard', 'refresh');
            }
        }
    }

    public function setLogin() {
        $this->lang->load('login/login', 'english');
        //$data['path'] = $this->uri->segment(1);
        if ($this->input->post('retail_store_username') && $this->input->post('retail_store_password')) {
            //Assign values to short variable.
            $username = $this->input->post('retail_store_username');
            $password = $this->input->post('retail_store_password');
            //Loding user model..
            $this->load->model('User_model');
            //returning user 
            $userExists = $this->User_model->checkUserForLogin($username, $password);
            //If user not exists return to login..
            if (!$userExists) {
                //assigning post values to data to reproduce the form field values....
                $data['return_username'] = $username;
                $data['return_password'] = $password;
                $data['login_error'] = lang('login_incorrect');
                $this->load->view('modules/login/login', $data);
                die($this->output->get_output());
            } else {
                $this->session->set_userdata('user', $userExists);
                if ($this->uri->segment(1) == 'login') {
                    redirect('dashboard', 'refresh');
                } else {
                    redirect($this->uri->uri_string(), 'refresh');
                }
            }
        } else {
            $this->load->view('modules/login/login');
            die($this->output->get_output());
        }
    }

    public function logout() {
        //Checking session exist or not and redirecting to login page....
        if ($this->session->userdata('user')) {
            $this->session->unset_userdata('user');
        }
        redirect('login', 'refresh');
    }

    public function moduleAccess() {

        $this->load->model('Access_model');
        $modulesList = $this->Access_model->getModuleDetails($this->current_user[0]['id']);
        $urlClass = $this->router->fetch_class();
        $urlAction = $this->router->fetch_method();
        foreach ($modulesList as $key => $value) {

            if (strtolower($urlClass) == strtolower($value['module_name'])) {
                if (strtolower($urlAction) == strtolower($value['module_action'])) {
                    $action = TRUE;
                    break;
                } elseif (strtolower($urlAction) == 'index' && strtolower($value['module_action']) == 'view') {
                    $action = TRUE;
                    break;
                } else {
                    $action = FALSE;
                }
            }
        }
        if ($action) {
            return TRUE;
        } else {
            if ($this->input->is_ajax_request()) {
                $arr = array('status' => 'error', 'action' => 'noaccess', 'message' => 'Unknown Error');
                echo json_encode($arr);
                exit;
            } else {
                $this->load->view('noaccess');
                die($this->output->get_output());
            }
        }
    }

}

?>
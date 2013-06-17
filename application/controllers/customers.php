<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customers extends MY_Auth {

    public function __construct() {
        parent::__construct();
        $this->load->model('customers_model');
        $this->load->model('Access_model'); //Loading access model
    }

    public function index() {

        //Loading Main menu links
        $menuLinks = $this->Access_model->mainMenuLinks($this->current_user[0]['id']);
        $data['menuLinks'] = $menuLinks;
        //loading the template
        $tpl = $this->tpl();
        $data['addLink'] = $tpl['addLink'];
        $data['tableBody'] = $tpl['tableBody'];
        $data['pageTitle'] = $tpl['pageTitle']; //Assign page title
        $data['container'] = 'modules/customers/index'; //Assign page content
        $this->load->view('index', $data); //Loading default view
    }

    protected function tpl() {
        $pageTitle = 'Customers'; //Page title
        $tableBody = '';
        $customers = $this->customers_model->getCustomerDetails();
        $path = array('add' => 'customers/add',
            'edit' => 'customers/edit',
            'delete' => 'customers/delete');
        //Loading Data table links
        $actionLinks = $this->Access_model->actionLinks($this->current_user[0]['id'], $this->router->fetch_class(), $path);
        foreach ($customers->result_array() as $key => $value) {
            $tableBody .= "<tr>
                <td>" . $value['first_name'] . "</td>
                <td>" . $value['last_name'] . "</td>
                <td>" . $value['email'] . "</td>
                <td>" . $value['phone_number'] . "</td>
                <td>" . str_replace('replaceId', $value['id'], $actionLinks['dataTableActionLinks']) . "</td>
                </tr>";
        }
        $addLink = $actionLinks['addLink'];
        return array('pageTitle' => $pageTitle,
            'tableBody' => $tableBody,
            'addLink' => $addLink);
    }

    public function add() {
        if ($_POST) {
            $path = array('add' => 'customers/add',
                'edit' => 'customers/edit',
                'delete' => 'customers/delete');
            //Loading Data table links
            $actionLinks = $this->Access_model->actionLinks($this->current_user[0]['id'], $this->router->fetch_class(), $path);
            $customerData = array('first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'phone_number' => $_POST['phone_number'],
                'address1' => $_POST['address1'],
                'address2' => $_POST['address2'],
                'city' => $_POST['city'],
                'state' => $_POST['state'],
                'zip' => $_POST['zip'],
                'country' => $_POST['country'],
                'comments' => $_POST['comments'],
                'status' => '1');
            $status = $this->customers_model->newCustomer($customerData);
            $returnCustomerData = $status->result_array();
            if ($status) {
                $arr = array('status' => 'success',
                    'action' => 'add',
                    'page' => 'customers',
                    'message' => 'Customer added successfully',
                    'data' => $returnCustomerData[0],
                    'dataLinks' => $actionLinks['dataTableActionLinks']);
            } else {
                $arr = array('status' => 'error',
                    'action' => 'add',
                    'page' => 'customers',
                    'message' => 'Unknown Error');
            }
            echo json_encode($arr);
        } else {
            $arr = array('status' => 'error',
                'action' => 'add',
                'page' => 'customers',
                'message' => 'Unknown Error');
            echo json_encode($arr);
        }
    }

    public function delete() {
        if ($_POST) {
            $status = $this->customers_model->deleteCustomer($_POST['row_id']);
            if ($status) {
                $arr = array('status' => 'success',
                    'action' => 'delete',
                    'page' => 'customers',
                    'message' => 'Customer deleted successfully');
                echo json_encode($arr);
            } else {
                $arr = array('status' => 'error',
                    'action' => 'delete',
                    'page' => 'customers',
                    'message' => 'Unknown Error');
                echo json_encode($arr);
            }
        } else {
            $arr = array('status' => 'error',
                'action' => 'delete',
                'page' => 'customers',
                'message' => 'Unknown Error');
            echo json_encode($arr);
        }
    }

    public function edit() {
        if ($_POST && isset($_POST['status'])) {
            $status = $this->customers_model->getEditDataById($_POST['row_id']);
            $returnCustomerData = $status->result_array();
            $this->session->set_userdata('currentEditId', $_POST['row_id']);
            if ($status) {
                $arr = array('status' => 'success',
                    'action' => 'edit',
                    'page' => 'customers',
                    'message' => '',
                    'data' => $returnCustomerData[0]);
                echo json_encode($arr);
            } else {
                $arr = array('status' => 'error',
                    'action' => 'edit',
                    'page' => 'customers',
                    'message' => 'Unknown Error');
                echo json_encode($arr);
            }
            unset($_POST['status']);
        } else {
            $customerData = array('first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'phone_number' => $_POST['phone_number'],
                'address1' => $_POST['address1'],
                'address2' => $_POST['address2'],
                'city' => $_POST['city'],
                'state' => $_POST['state'],
                'zip' => $_POST['zip'],
                'country' => $_POST['country'],
                'comments' => $_POST['comments']);
            $status = $this->customers_model->updateCustomerDetails($this->session->userdata('currentEditId'), $customerData);
            $returnCustomerData = $status->result_array();
            $this->session->unset_userdata('currentEditId');
            if ($status) {
                $arr = array('status' => 'success',
                    'action' => 'edit',
                    'page' => 'customers',
                    'message' => 'Customer successfully updated',
                    'data' => $returnCustomerData[0]);
                echo json_encode($arr);
            } else {
                $arr = array('status' => 'error',
                    'action' => 'edit',
                    'page' => 'customers',
                    'message' => 'Unknown Error');
                echo json_encode($arr);
            }
        }
    }

}

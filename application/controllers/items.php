<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Items extends MY_Auth {

    private $tableBody;

    public function __construct() {
        parent::__construct();
        $this->load->model('items_model');
        $this->load->model('Access_model'); //Loading access model
    }

    public function index() {
        $this->load->model('Access_model'); //Loading access model
        //Loading Main menu links
        $menuLinks = $this->Access_model->mainMenuLinks($this->current_user[0]['id']);
        $data['menuLinks'] = $menuLinks;
        //loading the template
        $tpl = $this->tpl();
        $data['addLink'] = $tpl['addLink'];
        $data['tableBody'] = $tpl['tableBody'];
        $data['pageTitle'] = $tpl['pageTitle']; //Assign page title
        $data['container'] = 'modules/items/index'; //Assign page content
        $this->load->view('index', $data); //Loading default view
    }

    protected function tpl() {
        $pageTitle = 'Items'; //Page title
        $tableBody = '';
        $items = $this->items_model->getItemDetails();
        $path = array('add' => 'items/add',
            'edit' => 'items/edit',
            'delete' => 'items/delete');
        //Loading Data table links
        $actionLinks = $this->Access_model->actionLinks($this->current_user[0]['id'], $this->router->fetch_class(), $path);
        foreach ($items->result_array() as $key => $value) {
            $tableBody .= "<tr>
                <td>" . $value['item_name'] . "</td>
                <td>" . $value['supplier'] . "</td>
                <td>" . $value['quantity'] . "</td>
                <td>" . $value['location'] . "</td>
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
            $path = array('add' => 'items/add',
                'edit' => 'items/edit',
                'delete' => 'items/delete');
            $actionLinks = $this->Access_model->actionLinks($this->current_user[0]['id'], $this->router->fetch_class(), $path);
            //if posting the values
            //Assigning all post values to database fields and eualing to single variable.....
            $itemData = array('upc_ean_isbn' => $_POST['upc_ean_isbn'],
                'item_name' => $_POST['item_name'],
                'supplier' => $_POST['supplier'],
                'cost_price' => $_POST['cost_price'],
                'unit_price' => $_POST['unit_price'],
                'promo_price' => $_POST['promo_price'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'tax1' => $_POST['tax1'],
                'quantity' => $_POST['quantity'],
                'location' => $_POST['location'],
                'description' => $_POST['description'],
                'status' => '1');
            //Passing values to newItem method in items model 
            //To store the data into items table
            $status = $this->items_model->newItem($itemData);
            //Returning data saved after successfully saved..
            $returnItemData = $status->result_array();
            //Checking the status of data wether saved or not
            if ($status) {
                $arr = array('status' => 'success',
                    'action' => 'add',
                    'page' => 'items',
                    'message' => 'Item added successfully',
                    'data' => $returnItemData[0],
                    'dataLinks' => $actionLinks['dataTableActionLinks']);
            } else {
                $arr = array('status' => 'error',
                    'action' => 'add',
                    'page' => 'items',
                    'message' => 'Unknown Error');
            }
            //returning json data..
            echo json_encode($arr);
        } else {
            //If no post data..
            $arr = array('status' => 'error',
                'action' => 'add',
                'page' => 'items',
                'message' => 'Unknown Error');
            echo json_encode($arr);
        }
    }

    public function edit() {
        if ($_POST && isset($_POST['status'])) {
            $status = $this->items_model->getEditDataById($_POST['row_id']);
            $returnItemData = $status->result_array();
            $this->session->set_userdata('currentEditId', $_POST['row_id']);
            if ($status) {
                $arr = array('status' => 'success',
                    'action' => 'edit',
                    'page' => 'items',
                    'message' => '',
                    'data' => $returnItemData[0]);
                echo json_encode($arr);
            } else {
                $arr = array('status' => 'error',
                    'action' => 'edit',
                    'page' => 'items',
                    'message' => 'Unknown Error');
                echo json_encode($arr);
            }
            unset($_POST['status']);
        } else {
            $itemData = array('upc_ean_isbn' => $_POST['upc_ean_isbn'],
                'item_name' => $_POST['item_name'],
                'supplier' => $_POST['supplier'],
                'cost_price' => $_POST['cost_price'],
                'unit_price' => $_POST['unit_price'],
                'promo_price' => $_POST['promo_price'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'tax1' => $_POST['tax1'],
                'quantity' => $_POST['quantity'],
                'location' => $_POST['location'],
                'description' => $_POST['description']);
            $status = $this->items_model->updateItemDetails($this->session->userdata('currentEditId'), $itemData);
            $returnItemData = $status->result_array();
            $this->session->unset_userdata('currentEditId');
            if ($status) {
                $arr = array('status' => 'success',
                    'action' => 'edit',
                    'page' => 'items',
                    'message' => 'Item successfully updated',
                    'data' => $returnItemData[0]);
                echo json_encode($arr);
            } else {
                $arr = array('status' => 'error',
                    'action' => 'edit',
                    'page' => 'items',
                    'message' => 'Unknown Error');
                echo json_encode($arr);
            }
        }
    }

    public function delete() {
        if ($_POST) {
            $status = $this->items_model->deleteItem($_POST['row_id']);
            if ($status) {
                $arr = array('status' => 'success',
                    'action' => 'delete',
                    'page' => 'items',
                    'message' => 'Item deleted successfully');
                echo json_encode($arr);
            } else {
                $arr = array('status' => 'error',
                    'action' => 'delete',
                    'page' => 'items',
                    'message' => 'Unknown Error');
                echo json_encode($arr);
            }
        } else {
            $arr = array('status' => 'error',
                'action' => 'delete',
                'page' => 'items',
                'message' => 'Unknown Error');
            echo json_encode($arr);
        }
    }

}

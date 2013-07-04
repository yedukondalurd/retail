<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php

class Employees extends MY_Auth {

    public function __construct() {
        parent::__construct();
        $this->load->model('employees_model');
        $this->load->model('Access_model'); //Loading access model
    }

    public function index() {
        //Loading Main menu links
        $menuLinks = $this->Access_model->mainMenuLinks($this->current_user[0]['id']);
        $data['menuLinks'] = $menuLinks;
//        $moduleNames = $this->employees_model->getModuleNames();
//        $data['moduleNames'] = $moduleNames;
        //loading the template
        $tpl = $this->tpl();
        $data['pageTitle'] = $tpl['pageTitle']; //Assign page title
        $data['addLink'] = $tpl['addLink'];
        $data['tableBody'] = $tpl['tableBody'];
        $data['container'] = 'modules/employees/index'; //Assign page content
        $this->load->view('index', $data); //Loading default view
    }

    protected function tpl() {
        $pageTitle = 'Employees'; //Page title
        $tableBody = '';
        $employees = $this->employees_model->getEmployeeDetails();
        $path = array('add' => 'employees/add',
            'edit' => 'employees/edit',
            'delete' => 'employees/delete');
        //Loading Data table links
        $actionLinks = $this->Access_model->actionLinks($this->current_user[0]['id'], $this->router->fetch_class(), $path);
        foreach ($employees->result_array() as $key => $value) {
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
            $permissions = (isset($_POST['permissions']) ? implode(',', $_POST['permissions']) : '');
            $path = array('add' => 'employees/add',
                'edit' => 'employees/edit',
                'delete' => 'employees/delete');
            //Loading Data table links
            $actionLinks = $this->Access_model->actionLinks($this->current_user[0]['id'], $this->router->fetch_class(), $path);
            $employeeData = array('first_name' => $_POST['first_name'],
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
                'username' => $_POST['username'],
                'password' => md5($_POST['password']),
                'module_id' => $permissions,
                'user_type' => 'employee',
                'user_status' => '1');
            $status = $this->employees_model->newEmployee($employeeData);
            $returnEmployeeData = $status->result_array();
            if ($status) {
                $arr = array('status' => 'success',
                    'action' => 'add',
                    'page' => 'employees',
                    'message' => 'Employee added successfully',
                    'data' => $returnEmployeeData[0],
                    'dataLinks' => $actionLinks['dataTableActionLinks']);
            } else {
                $arr = array('status' => 'error',
                    'action' => 'add',
                    'page' => 'employees',
                    'message' => 'Unknown Error');
            }
            echo json_encode($arr);
        } else {
            $arr = array('status' => 'error',
                'action' => 'add',
                'page' => 'employees',
                'message' => 'Unknown Error');
            echo json_encode($arr);
        }
    }

    public function edit() {
        if ($_POST && isset($_POST['status'])) {
            $status = $this->employees_model->getEditDataById($_POST['row_id']);
            $returnEmployeeData = $status->result_array();
            $this->session->set_userdata('currentEditId', $_POST['row_id']);
            if ($status) {
                $arr = array('status' => 'success',
                    'action' => 'edit',
                    'page' => 'employees',
                    'message' => '',
                    'data' => $returnEmployeeData[0]);
                echo json_encode($arr);
            } else {
                $arr = array('status' => 'error',
                    'action' => 'edit',
                    'page' => 'employees',
                    'message' => 'Unknown Error');
                echo json_encode($arr);
            }
            unset($_POST['status']);
        } else {
            $permissions = (isset($_POST['permissions']) ? implode(',', $_POST['permissions']) : '');
            //$password = (!empty($_POST['password']) ? "'password' => " . md5($_POST['password']) . "," : "");
            $employeeData = array('first_name' => $_POST['first_name'],
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
                'username' => $_POST['username'],
                'module_id' => $permissions,
                'user_type' => 'employee');
            if (!empty($_POST['password'])) {
                $employeeData['password'] = md5($_POST['password']);
            }
            $status = $this->employees_model->updateEmployeeDetails($this->session->userdata('currentEditId'), $employeeData);
            $returnEmployeeData = $status->result_array();
            $this->session->unset_userdata('currentEditId');
            if ($status) {
                $arr = array('status' => 'success',
                    'action' => 'edit',
                    'page' => 'employees',
                    'message' => 'Employee successfully updated',
                    'data' => $returnEmployeeData[0]);
                echo json_encode($arr);
            } else {
                $arr = array('status' => 'error',
                    'action' => 'edit',
                    'page' => 'employees',
                    'message' => 'Unknown Error');
                echo json_encode($arr);
            }
        }
    }

    public function delete() {
        if ($_POST) {
            $status = $this->employees_model->deleteEmployee($_POST['row_id']);
            if ($status) {
                $arr = array('status' => 'success',
                    'action' => 'delete',
                    'page' => 'employees',
                    'message' => 'Employee deleted successfully');
                echo json_encode($arr);
            } else {
                $arr = array('status' => 'error',
                    'action' => 'delete',
                    'page' => 'employees',
                    'message' => 'Unknown Error');
                echo json_encode($arr);
            }
        } else {
            $arr = array('status' => 'error',
                'action' => 'delete',
                'page' => 'employees',
                'message' => 'Unknown Error');
            echo json_encode($arr);
        }
    }

}

?>
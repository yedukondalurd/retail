<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php

Class Employees_model extends My_BaseModel {

    public function __construct() {
        parent::__construct();
    }

    function getEmployeeDetails() {
        $sql = "select id,first_name,last_name,email,phone_number from users__ where user_status='1' and user_type='employee'";
        $result = $this->db->query($sql);
        if ($result) {
            return $result;
        } else {
            return FALSE;
        }
    }

    function getModuleNames() {
        $sql = "select * from modules__";
        $result = $this->db->query($sql);
        if ($result) {
            return $result;
        } else {
            return FALSE;
        }
    }

    function newEmployee($employeeData) {
        $result = $this->db->insert('users__', $employeeData);
        $insert_id = $this->db->insert_id();

        if ($result) {
            return $this->getEmployeeById($insert_id);
        } else {
            return FALSE;
        }
    }

    function getEmployeeById($id) {
        $sql = "select id,first_name,last_name,email,phone_number from users__ where user_type='employee' and user_status='1' and id=" . $id;
        $result = $this->db->query($sql);
        if ($result) {
            return $result;
        } else {
            return FALSE;
        }
    }

    function getEditDataById($id) {
        $sql = "select id,first_name,last_name,email,phone_number,address1,
            address2,city,state,zip,country,comments,module_id,username from users__ where user_type='employee' and user_status='1' and id=" . $id;
        $result = $this->db->query($sql);
        if ($result) {
            return $result;
        } else {
            return FALSE;
        }
    }

    function updateEmployeeDetails($id, $employeeData) {
        $this->db->where('id', $id);
        $result = $this->db->update('users__', $employeeData);
        if ($result) {
            return $this->getEmployeeById($id);
        } else {
            return FALSE;
        }
    }

    function deleteEmployee($id) {
        $sql = "update users__ set user_status='-1' where user_type='employee' and id=" . $id;
        $result = $this->db->query($sql);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

?>
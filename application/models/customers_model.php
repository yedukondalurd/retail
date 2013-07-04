<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php

Class Customers_model extends My_BaseModel {

    public function __construct() {
        parent::__construct();
    }

    function getCustomerDetails() {
        $sql = "select id,first_name,last_name,email,phone_number from customers__ where status='1'";
        $result = $this->db->query($sql);
        if ($result) {
            return $result;
        } else {
            return FALSE;
        }
    }

    function newCustomer($customerData) {
        $result = $this->db->insert('customers__', $customerData);
        $insert_id = $this->db->insert_id();

        if ($result) {
            return $this->getCustomerById($insert_id);
        } else {
            return FALSE;
        }
    }

    function getCustomerById($id) {
        $sql = "select id,first_name,last_name,email,phone_number from customers__ where status='1' and id=" . $id;
        $result = $this->db->query($sql);
        if ($result) {
            return $result;
        } else {
            return FALSE;
        }
    }

    function deleteCustomer($id) {
        $sql = "update customers__ set status='-1' where id=" . $id;
        $result = $this->db->query($sql);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function getEditDataById($id) {
        $sql = "select id,first_name,last_name,email,phone_number from customers__ where status='1' and id=" . $id;
        $result = $this->db->query($sql);
        if ($result) {
            return $result;
        } else {
            return FALSE;
        }
    }

    function updateCustomerDetails($id, $customerData) {
        $this->db->where('id', $id);
        $result = $this->db->update('customers__', $customerData);
        if ($result) {
            return $this->getCustomerById($id);
        } else {
            return FALSE;
        }
    }

}

?>
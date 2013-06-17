<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php

Class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function checkUserForLogin($username, $password) {
        $query = "select id,username from users__ where user_status=1 and username='" . $username . "' and password='" . md5($password) . "'";
        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            return $result->result_array();
        } else {
            return FALSE;
        }
    }

}
?>


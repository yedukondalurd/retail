<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php

Class Install_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
public function install_status(){
$query=$this->db->query('select install_status from install');
return $query->result_array();
}

}
?>


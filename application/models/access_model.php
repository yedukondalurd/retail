<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php

Class Access_model extends My_BaseModel {

    public function __construct() {
        parent::__construct();
    }

    function getModuleDetails($userId) {
        $sql = "select module_name,module_action from modules__ where FIND_IN_SET(id,(select module_id from users__ where id=" . $userId . "))";
        $result = $this->db->query($sql);
        if ($result) {
            return $result->result_array();
        } else {
            return FALSE;
        }
    }

    function mainMenuLinks($userId) {
        $sql = "select distinct(module_name) from modules__ where FIND_IN_SET(id,(select module_id from users__ where id=" . $userId . "))";
        $result = $this->db->query($sql);
        $meniLinks = '';
        foreach ($result->result_array() as $key => $value) {
            $meniLinks.="<li class='" . $value['module_name'] . "'><a href=" . base_url() . ucfirst($value['module_name']) . ">" . ucfirst($value['module_name']) . "</a></li>";
        }
        return $meniLinks;
    }

    function actionLinks($userId, $module_name, $path) {
        $sql = "select distinct(module_action) from modules__ where FIND_IN_SET(id,(select module_id from users__ where id=" . $userId . " and module_name='" . $module_name . "'))";
        $result = $this->db->query($sql);
        $editLink = '';
        $deleteLink = '';
        $addLink = '';
        foreach ($result->result_array() as $key => $value) {
            if ($value['module_action'] == 'edit') {
                $editLink = "<a href='" . $path['edit'] . "' row_id=replaceId class='editEnqBtn'>Edit</a>";
                continue;
            }
            if ($value['module_action'] == 'delete') {
                $deleteLink = "<a href='" . $path['delete'] . "' row_id=replaceId class='delEnqBtn'>Delete</a>";
                continue;
            }
            if ($value['module_action'] == 'add') {
                $addLink = "<a href='" . $path['add'] . "' class='addEnqBtn'>Add " . ucfirst($module_name) . "</a>";
                continue;
            }
        }
        $dataTableActionLinks = $editLink . $deleteLink;
        return array('dataTableActionLinks' => $dataTableActionLinks,
            'addLink' => $addLink);
    }

}

?>
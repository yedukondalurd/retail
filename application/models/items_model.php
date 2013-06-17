<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php

Class Items_model extends My_BaseModel {

    public function __construct() {
        parent::__construct();
    }

    function getItemDetails() {
        $sql = "select id,item_name,supplier,quantity,location from items__ where status='1'";
        $result = $this->db->query($sql);
        if ($result) {
            return $result;
        } else {
            return FALSE;
        }
    }

    function newItem($itemData) {
        $result = $this->db->insert('items__', $itemData);
        $insert_id = $this->db->insert_id();
        if ($result) {
            return $this->getItemById($insert_id);
        } else {
            return FALSE;
        }
    }

    function getItemById($id) {
        $sql = "select id,item_name,supplier,quantity,location from items__ where status='1' and id=" . $id;
        $result = $this->db->query($sql);
        if ($result) {
            return $result;
        } else {
            return FALSE;
        }
    }

    function updateItemDetails($id, $itemData) {
        $this->db->where('id', $id);
        $result = $this->db->update('items__', $itemData);
        if ($result) {
            return $this->getItemById($id);
        } else {
            return FALSE;
        }
    }

    function getEditDataById($id) {
        $sql = "select * from items__ where status='1' and id=" . $id;
        $result = $this->db->query($sql);
        if ($result) {
            return $result;
        } else {
            return FALSE;
        }
    }

    function deleteItem($id) {
        $sql = "update items__ set status='-1' where id=" . $id;
        $result = $this->db->query($sql);
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

?>
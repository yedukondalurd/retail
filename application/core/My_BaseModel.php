<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php

class My_BaseModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getInsertQuery($table, $values) {
        $sql=sprintf('INSERT INTO `%s` (%s) VALUES (%s);',
                $table,
                join(', ', array_keys($values)),
                join(', ', array_fill(0, count($values), '?'))
                );
                $params = array_values($values);
        $sql_raw = strtr($sql, array('%' => '%%', '?' => '%s'));
        $toeval = '$sql = sprintf($sql_raw';
        for ($i = 0; $i < count($params); $i++)
            $toeval .= ', $this->quote($params[' . $i . '])';
        $toeval .= ');';
        eval($toeval);
        return $sql;
    }

    public function quote($str) {
        # React corresponding to en-/disabled magic_quotes_gpc.
        if (get_magic_quotes_gpc())
            $str = stripslashes($str);
        $str = mysql_real_escape_string($str);

        # Quote string if not an integer.
        //if (! is_numeric($str) or (intval($str) != $str))
        $str = "'$str'";
        return $str;
    }

}
?>
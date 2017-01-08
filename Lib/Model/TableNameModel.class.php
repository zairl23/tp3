<?php

class TableNameModel extends Model {

    public static $table = 'tp_table_name';

    public static $searchFields = array(
        array('name' => 'status', 'type' => 'select', 'operator' => 'in', 'values' => array('0,2', '0', '2')),
        array(
            'name' => 'word', 'type' => 'text','fields' => array(
            array('name' => 'desc', 'operator' => 'like'),
            array('name' => 'field1', 'table' => 'tp_relation', 'operator' => 'like', 'relation' => 'left join tp_relation on tp_table_name.id = tp_relation.table_id'),
        )),
    );

    public function _initialize()
    {
        $this->model = M('table_name');
    }

}

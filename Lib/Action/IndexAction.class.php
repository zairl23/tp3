<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
        // echo phpinfo();exit;
        $fields = TableNameModel::$searchFields;
        $this->assign("fields", $fields);

        foreach ($fields as $field) {
            $table = (!empty($field['table'])) ? : TableNameModel::$table;
            $pre = ($field['operator'] == 'like') ? '%' : '';
            if (!empty($field['relation'])) {
                $join[] = $field['relation'];
            }

            $$field['name'] = $this->_request($field['name']);
            $this->assign($field['name'], $$field['name']);

            if ($field['name'] == 'word') {
                foreach ($field['fields'] as $value) {
                    $relationTable = (!empty($value['table'])) ?  $value['table'] : TableNameModel::$table;
                    $relationPre = ($value['operator'] == 'like') ? '%' : '';
                    $where[$relationTable . '.' . $value['name']] = array($value['operator'], $relationPre . $$value['name'] . $relationPre);

                    if (!empty($value['relation'])) {
                        $join[] = $value['relation'];
                    }
                }
            } else {
                $map[$table . '.' . $field['name']] = array($field['operator'], $pre . $$field['name'] . $pre);
            }
        }

        if (!empty($where)) {
            $where['_logic'] = 'OR';
            $map['_complex'] = $where;
        }
        // var_dump($join);exit;
        $sql = M('table_name')->where($map)->join($join)->select(false);

        $this->assign("sql", $sql);

        $this->display();
    }
}

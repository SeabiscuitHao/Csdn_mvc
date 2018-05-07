<?php
    class BaseModel {
        public $mysqli;
        public $tableName; //留给子类自己赋值
        public function __construct() {
            $config = C();
            $this->mysqli = new mysqli($config['db_host'],$config['db_user'],$config['db_password'],$config['db_name']);
            $this->mysqli->query('set names utf8');
        }

        public function add($data) {
            if (empty($this->tableName)) {
                die('error: basemodel add');
            }
            $sql = "insert into {$this->tableName} ";
            $field = '';
            $value = '';

            foreach ($data as $k => $v) {
                $field .= $k. ",";
                if (is_int($v)) {
                    $value .= $v. ",";
                } else {
                    $value .= "'{$v}',";
                    //$value .= '"'.$v.'",';
                }
            }
            
            $field = rtrim($field, ',');
            $value = trim($value, ',');
            $sql = $sql . "(" . $field . ")" . " value " . "(" . $value . ")";
            // var_dump($sql);die;
            $query = $this->mysqli->query($sql);
            // var_dump($query);die();
            return $query;
        }

        public function del($where=array()) {
            if (empty($where)) {
                die('model: delete all error');
            }
            
            $whereStr = 'where 1';
            foreach ($where as $k => $v) {
                $whereStr .= ' and '.$k . "=" . $v;

            }
            //$whereStr = trim($whereStr, 'and ');
            //$whereStr .= '1';

            $sql = "delete from {$this->tableName} {$whereStr}";
            $query = $this->mysqli->query($sql);
            return $query;
        }

        public function select($where=array(), $offset=0,$limit=20, $order='id desc', $field=array()) {

            //字段
            if (!empty($field)) {
                $fieldStr = implode(',', $field);
            } else {
                $fieldStr = "*";
            }

            //where
            $whereStr = 'where 1';
            foreach ($where as $k => $v) {
                if (is_int($v)) {
                    $whereStr .= ' and '.$k . "=" . $v;
                } else {
                    $whereStr .= ' and '.$k . "=" . "'" . $v . "'";
                }

            }
            // var_dump($whereStr);die();
            //limit
            if (!empty($limit)) {
                $limitStr = "limit {$offset},{$limit}";
            } else {
                $limitStr = "";
            }

            //order by 
            if (!empty($order)) {
                $orderStr = "order by {$order}";
            } else {
                $orderStr = "";
            }

            //拼 sql
            $sql = "select {$fieldStr} from {$this->tableName} {$whereStr} {$orderStr} {$limitStr}";
            // var_dump($sql);
            $query = $this->mysqli->query($sql);
            $res = $query->fetch_all(MYSQLI_ASSOC);
            return $res;
        }
        public function update ($where,$data) {
            // update zt_blog set title = '123', content='qwe',category_id=1 where id = 3 and title = 'abc';
            // 
            // 
        }
    }
<?php
class CateModel extends BaseModel {
	public $tableName = 'tb_category';
	public function addCategory($category) {
		$data = array('category' => $category);
		$res = $this->add($data);
		return $res;
	}
	public function getCategory() {
		$res = $this->select();
		return $res;
	}
	public function getBlogByCate($id) {
		$where = array('id' => $id);
		$res = $this->select($where);
		// var_dump($res);die();
		return current($res);
	}
}
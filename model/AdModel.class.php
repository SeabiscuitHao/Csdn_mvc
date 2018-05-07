<?php
class AdModel extends BaseModel {
	public $tableName = 'tb_ad';
	public function getLists() {
		$res = $this->select();
		foreach ($res as $key => $value) {
			$img[] = $value['image'];
		}
		// var_dump($img);die();
		return $img;
		// var_dump(current($res));die();
	}
}
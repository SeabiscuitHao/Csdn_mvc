<?php
class UserModel extends BaseModel {
	public $tableName = 'tb_user';
	public function getUserInfoByPhone($phone) {
		$where = array('phone'=>$phone);
		$res = $this->select($where);		
		if (count($res) > 0) {
			$result = current($res);
		} else {
			$result = array();
		}
		return $result;
	}
	public function addUserInfo($username,$phone,$password) {
		$data = array(
			'username' => $username,
			'phone'    => $phone,
			'password' => $password,
		);
		$res = $this->add($data);
		return $res;
	}
	public function getUserById($id) {
		$where = array('id' => $id);
		$user = $this->select($where);
		return $user;
	}
}
<?php
class UserController {
	
	public function login() {
		include "./view/user/login.html";
	}

	public function doLogin() {
		$phone	  = empty($_POST['phone']) ? '' : $_POST['phone'];
		$password = empty($_POST['password']) ? '' : $_POST['password'];
		// $result = array('error_code'=>'0','message'=>'','data'=>array());
		if (empty($phone) || empty($password)) {
			// $result['error_code'] = 1;
			// $result['message'] = '参数错误';
			// $result['data'] = '';
			echo "error 参数错误";
			die();
		} 
		$res = D('user')->getUserInfoByPhone($phone);
			if ($res['password'] == $password) {
                $_SESSION['me'] = $res;
                // var_dump($_SESSION['me']);die();
				// echo "登陆成功";
				header("location:index.php?c=blog&a=lists");
			} else {
				echo "密码不正确";
			}
		}
	public function logout() {
		$_SESSION['me'] = array();
		header("location:index.php?c=user&a=login");
	}
	public function reg() {
		include "./view/user/reg.html";
	}

	public function doReg() {
		$username 	= $_POST['username'];
		$phone 		= $_POST['phone'];
		$password	= $_POST['password'];
		if (empty($username) || empty($phone) || empty($password)) {
			echo "error 参数错误";
		}

		$res = D('user')->addUserInfo($username,$phone,$password);

		if ($res !== false) {
			header('location:index.php?c=user&a=login');
		}
	}
}
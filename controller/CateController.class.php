<?php
class CateController {
	public function addCate() {
		$category = empty($_POST['category']) ? '' : $_POST['category'];
		if (empty($category)) {
			echo "参数错误";
		}
		$res = D('cate')->addCategory($category);
		if ($res !== false) {
			echo "添加成功";
		} else {
			echo "添加失败";
		}
	}
	public function lists() {
		$res = D('cate')->getCategory();
		// var_dump($res);die();
		// include "./view/blog/csdn.html";
	}

}
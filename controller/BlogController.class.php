<?php
class BlogController {
	public function addBlog() {
		$res = D('cate')->getCategory();
		include "./view/blog/publish.html";
	}
	public function doAdd() {
		$title  	 = empty($_POST['title']) ? '' : $_POST['title'];
		$content 	 = empty($_POST['content']) ? '' : $_POST['content'];
		$createtime  = date('Y-m-d,H:i:s');
		$cateid 	 = empty($_POST['cateid']) ? '' : $_POST['cateid'];
		$id 	   	 = $_SESSION['me']['id'];
		$user = D('user')->getUserById($id);
		$userinfo = current($user);

		foreach ($userinfo as $key => $value) {
			$username = $userinfo['username'];
		}

		$res = D('cate')->getCategory();
		foreach ($res as $key => $value) {
			$catename = $res[$key]['category'];
		}
		if (empty($title) || empty($content)) {
			echo "参数错误";
			die();
		}
		$res = D('blog')->addBlog($title,$content,$createtime,$username,$catename);
		if ($res !== false) {
			header("location:index.php?c=blog&a=lists");
		} else {
			echo "添加博客失败";
		}
	}

	public function lists() {
		$lists = D('blog')->getList();
		$res   = D('cate')->getCategory();
		$img   = D('ad')->getLists();
		include "./view/blog/csdn.html";
	}

	
	public function info() {
		$id = $_GET['id'];
		$res = D('blog')->getInfoById($id);
		include "./view/blog/csdn_blog_default.html";
	}

	public function cate() {
		$id = $_GET['cateid'];
		$res = D('cate')->getBlogByCate($id);
		$category = $res['category'];
		$blog = D('blog')->getInfoByCatename($category);
		$res = D('cate')->getCategory();
		include "./view/blog/csdn_blog_cate.html";
	}

	public function update() {
		$id = $_GET['id'];
		$info = D('blog')->getInfoById($id);
		$cate = D('cate')->getCategory();
		include "./view/blog/update.html";
	}

	public function doUpdate() {
		$id = $_POST['id'];
		$data = array(
			'id' => $_POST['id'],
			'title' => $_POST['title'],
			'catename' => $_POST['catename'],
		);
		$res = D('blog')->updateBlog($data,$id);
		if ($res !== false) {
			header("location:index.php?c=blog&a=lists");
		} else {
			echo "error";
		}
	}
}
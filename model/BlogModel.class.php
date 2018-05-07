<?php
class BlogModel extends BaseModel {
	public $tableName = 'tb_blog';
	public function getList() {
		$res = $this->select();
		// var_dump($res);die;
		return $res;
	}
	public function addBlog($title,$content,$createtime,$username,$catename) {
		$data = array(
			'createtime' => $createtime, 
			'title'		 => $title,
			'content' 	 => $content,
			'catename' 	 => $catename,
			'username'	 => $username,
		);
		// var_dump($data);die();
		$res = $this->add($data);
		// var_dump($res);die();
		return $res;
	}
	public function getInfoById($id) {
		$where = array('id' => $id);
		$res = $this->select($where);
		// var_dump($res);die();
		return current($res);
	}


	// public function getBlogInfo($blog_catename) {
	// 	$where = array('catename' => $blog_catename);
	// 	$res = $this->select($where);
	// 	return current($res);
	// }
	public function getInfoByCatename($category) {
		$where = array('catename' => $category);
		// var_dump($where);die();
		$res = $this->select($where);
		// var_dump($res);die();
		return $res;
	}

	public function updateBlog($data,$id) {
		$where = array('id'=>$id);
		$res = $this->update($data,$where);
		return $res;
	}
}
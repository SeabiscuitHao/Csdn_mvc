<?php
	function D($name) {
		static $res = array();
		//再次使用D方法时不用再走下面的if 直接使用
		if (empty($res[$name])) {
			$name = ucfirst($name);
			$classname = $name.'Model';
			include_once "./model/{$classname}.class.php";
			$model = new $classname();
			$res[$name] = $model;
		}
		return $res[$name];
	}
    function upLoadFile($name) {
        $path    = './public/uploads/';
        //拼文件名
        $filename = 'I'.time().rand(1,10).$_FILES[$name]['name'];
        $image = $path.$filename;

        //移动临时文件 到 指定的文件夹
        move_uploaded_file($_FILES[$name]['tmp_name'],$image);
        return $image;
    }
    function C() {
	    //静态变量
	    static $res = array();
	    if (empty($res)) {
	        $res = include_once "./config/config.php";
	    }
	    return $res;
    }
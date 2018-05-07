<?php

    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Method:POST,GET');
    //三元运算符  设置默认值
    session_start();
    $c = !empty($_GET['c']) ? $_GET['c'] : 'blog';
    $a = !empty($_GET['a']) ? $_GET['a'] : 'lists';

    header("Content-type:text/html;charset=utf-8");
    include "./common/function.php";

    $c = ucfirst($c); //首字母变大写

    function __autoload($a) {
        //自动加载控制器
        if (strpos($a, "Controller") !== false) {

            include_once "./controller/{$a}.class.php";

        } elseif(strpos($a, "Model") !== false) {

            include_once "./model/{$a}.class.php";

        } else {

            die('class not found');

        }
        
    }
    define('STATIC_URL', '/Zt/csdn_blog/public/home');
    $className = "{$c}Controller";
    $obj = new $className();
    $obj->$a();
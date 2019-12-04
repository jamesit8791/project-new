<?php
    session_start();
    $session=session_id();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    error_reporting(E_ALL & ~E_NOTICE & ~8192);
    @define ( '_source' , './sources/');
    @define ( '_lib' , './libraries/');
    @define ( '_template' , './templates/');
    if(!isset($_SESSION['lang']) || $_SESSION['lang']=='')
    {
        $_SESSION['lang']='vi';
    }
    $lang=$_SESSION['lang'];
    include_once _lib."config.php";
    include_once _lib."constant.php";
    include_once _lib."functions.php";
    $http = checkProtocol();
    include_once _lib."class.database.php";
    include_once _source."lang_$lang.php";
    include_once _lib."functions_giohang.php";
    
    include_once _lib."file_requick.php";
    include_once _lib."counter.php";
    include "sources/custom.php";
    
    include_once "index_website.php";
?>
<?php 
	include_once "ajax_lib.php";
	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false)){
		header('Content-Type: text/html; charset=utf-8');
		die("Bạn Không có quyền vào đây !");
	}else{
		if(isset($_POST["id"])){
			$sql = "update ".(string)$_POST["bang"]." SET ".(string)$_POST["type"]."=".(string)$_POST["value"]." WHERE  id = ".(int)$_POST["id"]."";
			$data = mysql_query($sql) or die("Not query sql");
		}
	}
?>
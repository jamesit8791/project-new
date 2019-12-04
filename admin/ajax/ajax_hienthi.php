<?php 
	include_once "ajax_lib.php";
	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false)){
		header('Content-Type: text/html; charset=utf-8');
		die("Bạn Không có quyền vào đây !");
	}else{
		if(isset($_POST["id"])){

			$table = htmlspecialchars($_POST["bang"]);
			$value = htmlspecialchars($_POST["value"]);
			$id = htmlspecialchars($_POST["id"]);

			$sql = "update ".." SET ".$table."=".$value." WHERE  id = ".$id."";
			$data = mysql_query($sql) or die("Not query sql");
		}
	}
?>
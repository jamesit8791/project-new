<?php
	include_once "ajax_lib.php";
	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false)){
		header('Content-Type: text/html; charset=utf-8');
		die("Bạn Không có quyền vào đây !");
	}else{
		$table = (string)$_POST['table'];
		$id = (int)$_POST['id'];
		$value = (int)$_POST['value'];

		$data['stt'] = $value;
		$d->setTable($table);
		$d->setWhere('id', $id);
		$d->update($data);
	}
?>
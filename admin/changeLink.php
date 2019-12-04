<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , '../libraries/');

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);


	$vl = $_POST['vl'];

	$title = changeTitle($vl);


	$array_list = array(
		'das' => str_replace(" ","",$title)
	);
	echo json_encode($array_list);
	;
	
?>
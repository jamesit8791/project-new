<?php

	if(!defined('_lib')) die("Error");
	function nettuts_error_handler($number, $message, $file, $line, $vars)
	{
		if ( ($number !== E_NOTICE) && ($number < 2048) ) {
			include 'templates/error_tpl.php';
			die();
		}
	}
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	error_reporting(E_ALL & ~E_NOTICE & ~8192);

	$config_url=$_SERVER["SERVER_NAME"].'/12-2019/shatoancau-1672519w';
	$config['debug']=1;
	$config['lang'] = array(
		"vi" => "Tiếng Việt"
	);

	$config_email="noreply@demo63.ninavietnam.com.vn";
	$config_pass="xYXtH9KhQ";
	$config_ip="116.193.76.23";

	$config['database']['servername'] = 'localhost';
	$config['database']['username'] = 'root';
	$config['database']['password'] = '';
	$config['database']['database'] = 'nina_shatoancau_1672519w';
	$config['database']['refix'] = 'table_';
	$config['salt']='!)aO.8ynI4';
	/*O5Z6QVX4*/
	$config['login']['attempt'] = 5;
	$config['login']['delay'] = 15;
	
	$config['index'] = 0;
	$config['facebook-id'] = '161909414494428';
	$config['zalo-id'] = '3607710785381490435';

	$config['author']['name'] = 'Nguyễn Thành Thắng';
	$config['author']['nickname'] = 'James Nguyễn';
	$config['author']['email'] = 'thanhthangnina@gmail.com';

	$config['page']['limit-index'] = "limit 0,8";
	// product or article
	$config['schema'] = 'product';
	$config['date_create'] = time();

	$config['key'] = '6LfK4p4UAAAAABJXVMMlCQ4KMNPY0YQot_COH8vI';
	$config['keysecret'] = '6LfK4p4UAAAAAMawRj2rUFJoo2-JHLiEKo5IMFpB';
	

?>

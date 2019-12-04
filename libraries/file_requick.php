<?php
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
	$d = new database($config['database']);

	$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
	if ($page <= 0) $page = 1;

	$d->reset();
	$sql_setting = "select * from #_setting limit 0,1";
	$d->query($sql_setting);
	$row_setting= $d->fetch_array();

	include_once _lib."data_requick.php";
	
	switch($com){

		
		case 'gio-hang':
			$title_cat = $bread = $title =  _cart;
			$source = "giohang";
			$template = "giohang";
			$type_og = "object";
			break;

		case 'thanh-toan':
			$title_cat = $title = $bread = _order;
			$source = "orders";
			$template = "orders";
			$type_og = "object";
			break;
		
		case 'gioi-thieu':
			$title_cat = $title = $bread = _about;
			$type_com = 'gioi-thieu';
			$source = "baiviet";
			$template = "baiviet_detail";
			break;
		
		
		case 'san-pham':
			$title_cat = $title = $bread = _product;
			$type_com = 'san-pham';
			$source = "productall";
			$type_og = isset($_GET['id']) ? "article" : "object";
			$template =isset($_GET['id']) ? "product_detail" : "product";
			break;
		case 'chinh-sach':
			$title_cat = $title = $bread = 'Chính sách';
			$type_com = 'chinh-sach';
			$source = "news";
			$type_og = isset($_GET['id']) ? "article" : "object";
			$template =isset($_GET['id']) ? "news_detail" : "chinhanh";
			break;
		case 'tin-tuc':
			$title_cat = $title = $bread = _news;
			$type_com = 'tin-tuc';
			$source = "news";
			$type_og = isset($_GET['id']) ? "article" : "object";
			$template =isset($_GET['id']) ? "news_detail" : "news";
			break;
		case 'dich-vu':
			$title_cat = $title = $bread = _service;
			$type_com = 'dich-vu';
			$source = "news";
			$type_og = isset($_GET['id']) ? "article" : "object";
			$template =isset($_GET['id']) ? "news_detail" : "news";
			break;
		
		case 'tuyen-dung':
			$title_cat = $title = $bread = _recruitment;
			$type_com = 'tuyen-dung';
			$source = "news";
			$type_og = isset($_GET['id']) ? "article" : "object";
			$template =isset($_GET['id']) ? "news_detail" : "news";
			break;

		case 'hinh-anh':
			$title_cat = $title = $bread = 'Thư viện ảnh';
			$type_com = 'album';
			$source = "thuvienanh";
			$type_og = isset($_GET['id']) ? "article" : "object";
			$template =isset($_GET['id']) ? "thuvienanh_detail" : "thuvienanh";
			break;
		
		case 'lien-he':
			$title_cat = $title = $bread = _contact;
			$source = "contact";
			$template = "contact";
			$type_og = "object";
			break;
		
		case 'chi-duong':
			$template = "chiduong";
			break;
		case 'mobile':
			$source = "mobile";
			break;
		case 'desktop':
			$source = "desktop";
			break;
		
		case 'hoi-dap':
			$source = "hoidap";
			$template = "hoidap";
			$type_og = "object";
			break;

		case 'video':
			$source = "video";
			$template = "video";
			$type_og = "object";
			break;



		case 'dang-ky':
			$title_cat =$title =$bread = _register;
			$source = "register";
			$template = "register";
			$type_og = "object";
			break;
		case 'dang-nhap':
			$title_cat = $title = $bread = _login;
			$source = "login";
			$template = "login";
			$type_og = "object";
			break;
		case 'dieu-khoan-su-dung':
			$title_cat = $title = $bread = _terms_of_use;
			$type_com = 'dieu-khoan-su-dung';
			$source = "baiviet";
			$template = "baiviet_detail";
			$type_og = "object";
			break;
		case 'chinh-sach-bao-mat':
			$title_cat = $title = $bread = _privacy_policy;
			$type_com = 'chinh-sach-bao-mat';
			$source = "baiviet";
			$template = "baiviet_detail";
			$type_og = "object";
			break;
		case 'quen-mat-khau':
			$title_cat = $title = $bread = _forgot_password;
			$source = "forgot_password";
			$template = "user/forgot_password";
			$type_og = "object";
			break;
		case 'thong-tin-ca-nhan':
			$title_cat = $title = $bread = _profile;
			$source = "user";
			$template = "user/profile";
			$type_og = "object";
			break;
		case 'doi-mat-khau':
			$title_cat = $title = $bread = _reset_password;
			$source = "user";
			$template = "user/reset_password";
			$type_og = "object";
			break;
		case 'logout':
			$source = "logout";
			break;
		case 'search':
			$source = "search";
			$template = "product";
			$type_og = "object";
			break;
		case 'tag':
			$source = "search";
			$template = "product";
			$type_og = "object";
			break;

		case 'ngon-ngu':
			if(isset($_GET['lang']))
			{
				switch($_GET['lang'])
					{
					case 'vi':
						$_SESSION['lang'] = 'vi';
						break;
					case 'en':
						$_SESSION['lang'] = 'en';
						break;
					default:
						$_SESSION['lang'] = 'vi';
						break;
					}
			}
			else{
				$_SESSION['lang'] = 'vi';
			}
			redirect($_SERVER['HTTP_REFERER']);
			break;

		case '': 
			$source = 'index';
			$template = 'index'; 
			$type_og = "website";
			break;
		default:
			header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
			include_once '404.php';
			break;
	}
	if($config['index']==1){
		if($_SERVER["REQUEST_URI"]=='/index.php'){
			header('Location: '.$http.$config_url);
		}
	}
	if($source!="") include _source.$source.".php";
	
?>

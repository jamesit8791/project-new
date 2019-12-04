<?php
	$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";
	switch ($com) {
		case "info":
		  	switch ($type) {
		  		
		  		case 'gioi-thieu':
				  	@define ('_title', "Giới thiệu");
				  	@define ('_title_dm', "giới thiệu");

				  	$config_info['title'] = 'Quản lý '._title_dm;
				  	$config_info['full'] = false;
				  	$config_info['img'] = true;
				  	$config_info['img-width'] = 300;
				  	$config_info['img-height'] = 300;
				  	$config_info['img-ratio'] = 2;
				  	$config_info['img-gallery'] = true;
				  	$config_info['mota'] = false;
				  	$config_info['mota-ckeditor'] = false;
				  	$config_info['noidung'] = true;
				  	$config_info['noidung-ckeditor'] = true;
				  	$config_info['seo'] = true;
				  	break;
				case 'dieu-khoan-su-dung-dich-vu':
				  	@define ('_title', "Điều khoản sử dụng dịch vụ");
				  	@define ('_title_dm', "Điều khoản sử dụng dịch vụ");

				  	$config_info['title'] = 'Quản lý '._title_dm;
				  	$config_info['full'] = false;
				  	$config_info['img'] = false;
				  	$config_info['img-width'] = 300;
				  	$config_info['img-height'] = 300;
				  	$config_info['img-ratio'] = 2;
				  	$config_info['img-gallery'] = true;
				  	$config_info['mota'] = false;
				  	$config_info['mota-ckeditor'] = false;
				  	$config_info['noidung'] = true;
				  	$config_info['noidung-ckeditor'] = true;
				  	$config_info['seo'] = true;
				  	break;
		  		default:
		  			@define ('_title', "Bài viết");
				  	@define ('_title_dm', "bài viết");

				  	$config_info['title'] = 'Quản lý '._title_dm;
				  	$config_info['full'] = false;
				  	$config_info['img'] = true;
				  	$config_info['img-width'] = 300;
				  	$config_info['img-height'] = 300;
				  	$config_info['img-ratio'] = 2;
				  	$config_info['img-gallery'] = true;
				  	$config_info['mota'] = true;
				  	$config_info['mota-ckeditor'] = false;
				  	$config_info['noidung'] = true;
				  	$config_info['noidung-ckeditor'] = true;
				  	$config_info['seo'] = true;
		  			break;
		  	}
		  	break;

		default:
		 	@define ('_width_thumb', 100);
		  	@define ('_height_thumb', 100);
		  	@define ('_title', "Cập nhật hình ảnh");
		  	break;
	}

?>
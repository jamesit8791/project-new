<?php
	$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";
	switch ($com) {
		case "bannerqc":
		  	switch ($type) {
		  		case 'logo':
				  	@define ('_title', "Logo");
				  	@define ('_title_dm', "logo");
				  	$config_info['title'] = 'Quản lý '._title_dm;
				  	$config_info['full'] = false;
				  	$config_info['img'] = true;
				  	$config_info['img-width'] = 66;
				  	$config_info['img-height'] = 113;
				  	$config_info['img-ratio'] = 1;
				  	$config_info['link'] = false;
				  	break;
				case 'quangcaocenter':
				  	@define ('_title', "Quảng cáo center");
				  	@define ('_title_dm', "Quảng cáo center");
				  	$config_info['title'] = 'Quản lý '._title_dm;
				  	$config_info['full'] = false;
				  	$config_info['img'] = true;
				  	$config_info['img-width'] = 1366;
				  	$config_info['img-height'] = 418;
				  	$config_info['img-ratio'] = 1;
				  	$config_info['link'] = true;
				  	break;
				case 'logo_bottom':
				  	@define ('_title', "Logo bottom");
				  	@define ('_title_dm', "Logo bottom");
				  	$config_info['title'] = 'Quản lý '._title_dm;
				  	$config_info['full'] = false;
				  	$config_info['img'] = true;
				  	$config_info['img-width'] = 134;
				  	$config_info['img-height'] = 178;
				  	$config_info['img-ratio'] = 1;
				  	$config_info['link'] = false;
				  	break;
				case 'popup':
				  	@define ('_title', "Popup");
				  	@define ('_title_dm', "Popup");
				  	$config_info['title'] = 'Quản lý '._title_dm;
				  	$config_info['full'] = false;
				  	$config_info['img'] = true;
				  	$config_info['img-width'] = 600;
				  	$config_info['img-height'] = 500;
				  	$config_info['img-ratio'] = 2;
				  	$config_info['link'] = true;
				  	break;

				case 'banner_top':
				  	@define ('_title', "Baner top");
				  	@define ('_title_dm', "baner top");
				  	$config_info['title'] = 'Quản lý '._title_dm;
				  	$config_info['full'] = false;
				  	$config_info['img'] = true;
				  	$config_info['img-width'] = 584;
				  	$config_info['img-height'] = 120;
				  	$config_info['img-ratio'] = 1;
				  	$config_info['link'] = false;
				  	break;
				case 'bg_content':
				  	@define ('_title', "Background content");
				  	@define ('_title_dm', "Background content");
				  	$config_info['title'] = 'Quản lý '._title_dm;
				  	$config_info['full'] = false;
				  	$config_info['img'] = true;
				  	$config_info['img-width'] = 1366;
				  	$config_info['img-height'] = 680;
				  	$config_info['img-ratio'] = 1;
				  	$config_info['link'] = false;
				  	break;
				case 'bg_visao':
				  	@define ('_title', "Background new arrivals");
				  	@define ('_title_dm', "Background new arrivals");
				  	$config_info['title'] = 'Quản lý '._title_dm;
				  	$config_info['full'] = false;
				  	$config_info['img'] = true;
				  	$config_info['img-width'] = 1366;
				  	$config_info['img-height'] = 400;
				  	$config_info['img-ratio'] = 1;
				  	$config_info['link'] = false;
				  	break;
				case 'bg_dknt':
				  	@define ('_title', "Background báo giá");
				  	@define ('_title_dm', "Background báo giá");
				  	$config_info['title'] = 'Quản lý '._title_dm;
				  	$config_info['full'] = false;
				  	$config_info['img'] = true;
				  	$config_info['img-width'] = 1366;
				  	$config_info['img-height'] = 500;
				  	$config_info['img-ratio'] = 1;
				  	$config_info['link'] = false;
				  	break;
				case 'bg_footer':
				  	@define ('_title', "Background footer");
				  	@define ('_title_dm', "Background footer");
				  	$config_info['title'] = 'Quản lý '._title_dm;
				  	$config_info['full'] = false;
				  	$config_info['img'] = true;
				  	$config_info['img-width'] = 1366;
				  	$config_info['img-height'] = 400;
				  	$config_info['img-ratio'] = 1;
				  	$config_info['link'] = false;
				  	break;
				case 'bocongthuong':
				  	@define ('_title', "Bộ công thương");
				  	@define ('_title_dm', "Bộ công thương");
				  	$config_info['title'] = 'Quản lý '._title_dm;
				  	$config_info['full'] = false;
				  	$config_info['img'] = true;
				  	$config_info['img-width'] = 200;
				  	$config_info['img-height'] = 100;
				  	$config_info['img-ratio'] = 1;
				  	$config_info['link'] = true;
				  	break;
				  	  	
				case 'hinhdaidien':
				  	@define ('_title', "Hình share link");
				  	@define ('_title_dm', "hình share link");
				  	$config_info['title'] = 'Quản lý '._title_dm;
				  	$config_info['full'] = false;
				  	$config_info['img'] = true;
				  	$config_info['img-width'] = 300;
				  	$config_info['img-height'] = 300;
				  	$config_info['img-ratio'] = 2;
				  	$config_info['link'] = true;
				  	break;

		  		default:
		  			@define ('_title', "Hình ảnh");
				  	@define ('_title_dm', "hình ảnh");
				  	$config_info['title'] = 'Quản lý '._title_dm;
				  	$config_info['full'] = false;
				  	$config_info['img'] = true;
				  	$config_info['img-width'] = 300;
				  	$config_info['img-height'] = 300;
				  	$config_info['img-ratio'] = 2;
				  	$config_info['link'] = true;
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

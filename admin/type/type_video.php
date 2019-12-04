<?php
	$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";
	switch ($com) {
		case "video":
		  	switch ($type) {
		  		case 'video':
				  	@define ('_title', "Video clips");
				  	@define ('_title_dm', "video clips");

				  	$config_info['title'] = 'Quản lý '._title_dm;
				  	$config_info['full'] = false;
				  	$config_info['img'] = true;
				  	$config_info['img-width'] = 300;
				  	$config_info['img-height'] = 300;
				  	$config_info['img-ratio'] = 1;
				  	$config_info['link'] = true;
				  	$config_info['mota'] = true;
				  	$config_info['mota-ckeditor'] = true;
				  	$config_info['seo'] = false;
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
				  	$config_info['mota'] = true;
				  	$config_info['mota-ckeditor'] = true;
				  	$config_info['seo'] = false;
		  			break;
		  	}
		  	break;

		default:
		 	@define ('_width_thumb', 100);
		  	@define ('_height_thumb', 100);
		  	@define ('_title', "Cập nhật video");
		  	@define ('_title_dm', "video");
		  	break;
	}

?>
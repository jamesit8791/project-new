<?php
	$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";
	switch ($com) {
		case "baiviet":
		  	switch ($type) {
		  		
		  		case 'tin-tuc':
				  	@define ('_title', "Bài viết");
				  	@define ('_title_dm', "bài viết");

				  	$config_pr['title'] = 'Danh sách '._title_dm;
				  	$config_pr['full'] = false;
				  	$config_pr['img'] = true;
				  	$config_pr['img-width'] = 600;
				  	$config_pr['img-height'] = 400;
				  	$config_pr['img-ratio'] = 1;
				  	$config_pr['img-gallery'] = false;
				  	$config_pr['noibat'] = true;
				  	$config_pr['mota'] = true;
				  	$config_pr['noidung'] = true;
				  	$config_pr['seo'] = true;
				  	$config_pr['tag'] = false;

				  	$cap1 = false;
					  	$config_cap1['title'] = 'Danh mục '._title_dm.' cấp 1';
					  	$config_cap1['full'] = true;
					  	$config_cap1['img'] = true;
					  	$config_cap1['img-width'] = 300;
					  	$config_cap1['img-height'] = 300;
					  	$config_cap1['img-ratio'] = 2;
					  	$config_cap1['mota'] = false;
					  	$config_cap1['seo'] = true;
					  	$config_cap1['img-qc'] = false;
					  	$config_cap1['img-qc-width'] = 300;
					  	$config_cap1['img-qc-height'] = 300;
					  	$config_cap1['img-qc-ratio'] = 2;

				  	$cap2 = false;
					  	$config_cap2['title'] = 'Danh mục '._title_dm.' cấp 2';
					  	$config_cap2['full'] = true;
					  	$config_cap2['img'] = true;
					  	$config_cap2['img-width'] = 300;
					  	$config_cap2['img-height'] = 300;
					  	$config_cap2['img-ratio'] = 2;
					  	$config_cap2['mota'] = false;
					  	$config_cap2['seo'] = true;
					  	$config_cap2['img-qc'] = false;

				  	$cap3 = false;
					  	$config_cap3['title'] = 'Danh mục '._title_dm.' cấp 3';
					  	$config_cap3['full'] = true;
					  	$config_cap3['img'] = true;
					  	$config_cap3['img-width'] = 300;
					  	$config_cap3['img-height'] = 300;
					  	$config_cap3['img-ratio'] = 2;
					  	$config_cap3['mota'] = false;
					  	$config_cap3['seo'] = true;
					  	$config_cap3['img-qc'] = false;

				  	break;
				case 'vi-sao':
				  	@define ('_title', "Vì sao");
				  	@define ('_title_dm', "Vì sao");

				  	$config_pr['title'] = 'Danh sách '._title_dm;
				  	$config_pr['full'] = true;
				  	$config_pr['img'] = true;
				  	$config_pr['img-width'] = 80;
				  	$config_pr['img-height'] = 70;
				  	$config_pr['img-ratio'] = 1;
				  	$config_pr['img-gallery'] = false;
				  	$config_pr['noibat'] = false;
				  	$config_pr['mota'] = false;
				  	$config_pr['noidung'] = false;
				  	$config_pr['seo'] = false;
				  	$config_pr['tag'] = false;

				  	$cap1 = false;
					  	$config_cap1['title'] = 'Danh mục '._title_dm.' cấp 1';
					  	$config_cap1['full'] = true;
					  	$config_cap1['img'] = true;
					  	$config_cap1['img-width'] = 300;
					  	$config_cap1['img-height'] = 300;
					  	$config_cap1['img-ratio'] = 2;
					  	$config_cap1['mota'] = false;
					  	$config_cap1['seo'] = true;
					  	$config_cap1['img-qc'] = false;
					  	$config_cap1['img-qc-width'] = 300;
					  	$config_cap1['img-qc-height'] = 300;
					  	$config_cap1['img-qc-ratio'] = 2;

				  	$cap2 = false;
					  	$config_cap2['title'] = 'Danh mục '._title_dm.' cấp 2';
					  	$config_cap2['full'] = true;
					  	$config_cap2['img'] = false;
					  	$config_cap2['img-width'] = 300;
					  	$config_cap2['img-height'] = 300;
					  	$config_cap2['img-ratio'] = 2;
					  	$config_cap2['mota'] = false;
					  	$config_cap2['seo'] = true;
					  	$config_cap2['img-qc'] = false;

				  	$cap3 = false;
					  	$config_cap3['title'] = 'Danh mục '._title_dm.' cấp 3';
					  	$config_cap3['full'] = true;
					  	$config_cap3['img'] = true;
					  	$config_cap3['img-width'] = 300;
					  	$config_cap3['img-height'] = 300;
					  	$config_cap3['img-ratio'] = 2;
					  	$config_cap3['mota'] = false;
					  	$config_cap3['seo'] = true;
					  	$config_cap3['img-qc'] = false;

				  	break;
				case 'chinh-sach':
				  	@define ('_title', "Chính sách");
				  	@define ('_title_dm', "Chính sách");

				  	$config_pr['title'] = 'Danh sách '._title_dm;
				  	$config_pr['full'] = false;
				  	$config_pr['img'] = true;
				  	$config_pr['img-width'] = 600;
				  	$config_pr['img-height'] = 400;
				  	$config_pr['img-ratio'] = 1;
				  	$config_pr['img-gallery'] = false;
				  	$config_pr['noibat'] = false;
				  	$config_pr['mota'] = true;
				  	$config_pr['noidung'] = true;
				  	$config_pr['seo'] = false;
				  	$config_pr['tag'] = false;

				  	$cap1 = false;
					  	$config_cap1['title'] = 'Danh mục '._title_dm.' cấp 1';
					  	$config_cap1['full'] = true;
					  	$config_cap1['img'] = true;
					  	$config_cap1['img-width'] = 300;
					  	$config_cap1['img-height'] = 300;
					  	$config_cap1['img-ratio'] = 2;
					  	$config_cap1['mota'] = false;
					  	$config_cap1['seo'] = true;
					  	$config_cap1['img-qc'] = false;
					  	$config_cap1['img-qc-width'] = 300;
					  	$config_cap1['img-qc-height'] = 300;
					  	$config_cap1['img-qc-ratio'] = 2;

				  	$cap2 = false;
					  	$config_cap2['title'] = 'Danh mục '._title_dm.' cấp 2';
					  	$config_cap2['full'] = true;
					  	$config_cap2['img'] = false;
					  	$config_cap2['img-width'] = 300;
					  	$config_cap2['img-height'] = 300;
					  	$config_cap2['img-ratio'] = 2;
					  	$config_cap2['mota'] = false;
					  	$config_cap2['seo'] = true;
					  	$config_cap2['img-qc'] = false;

				  	$cap3 = false;
					  	$config_cap3['title'] = 'Danh mục '._title_dm.' cấp 3';
					  	$config_cap3['full'] = true;
					  	$config_cap3['img'] = true;
					  	$config_cap3['img-width'] = 300;
					  	$config_cap3['img-height'] = 300;
					  	$config_cap3['img-ratio'] = 2;
					  	$config_cap3['mota'] = false;
					  	$config_cap3['seo'] = true;
					  	$config_cap3['img-qc'] = false;

				  	break;
				case 'dich-vu':
				  	@define ('_title', "Dịch vụ");
				  	@define ('_title_dm', "Dịch vụ");
				  	$config_pr['title'] = 'Danh sách '._title_dm;
				  	$config_pr['full'] = false;
				  	$config_pr['img'] = true;
				  	$config_pr['img-width'] = 280;
				  	$config_pr['img-height'] = 220;
				  	$config_pr['img-ratio'] = 1;
				  	$config_pr['img-gallery'] = false;
				  	$config_pr['noibat'] = true;
				  	$config_pr['mota'] = true;
				  	$config_pr['noidung'] = true;
				  	$config_pr['seo'] = true;
				  	$config_pr['tag'] = false;

				  	$cap1 = true;
					  	$config_cap1['title'] = 'Danh mục '._title_dm.' cấp 1';
					  	$config_cap1['full'] = true;
					  	$config_cap1['img'] = true;
					  	$config_cap1['img-width'] = 280;
					  	$config_cap1['img-height'] = 220;
					  	$config_cap1['img-ratio'] = 1;
					  	$config_cap1['mota'] = true;
					  	$config_cap1['seo'] = true;
					  	$config_cap1['img-qc'] = false;
					  	$config_cap1['img-qc-width'] = 300;
					  	$config_cap1['img-qc-height'] = 300;
					  	$config_cap1['img-qc-ratio'] = 2;

				  	$cap2 = true;
					  	$config_cap2['title'] = 'Danh mục '._title_dm.' cấp 2';
					  	$config_cap2['full'] = true;
					  	$config_cap2['img'] = false;
					  	$config_cap2['img-width'] = 300;
					  	$config_cap2['img-height'] = 300;
					  	$config_cap2['img-ratio'] = 2;
					  	$config_cap2['mota'] = false;
					  	$config_cap2['seo'] = true;
					  	$config_cap2['img-qc'] = false;

				  	$cap3 = false;
					  	$config_cap3['title'] = 'Danh mục '._title_dm.' cấp 3';
					  	$config_cap3['full'] = true;
					  	$config_cap3['img'] = true;
					  	$config_cap3['img-width'] = 300;
					  	$config_cap3['img-height'] = 300;
					  	$config_cap3['img-ratio'] = 2;
					  	$config_cap3['mota'] = false;
					  	$config_cap3['seo'] = true;
					  	$config_cap3['img-qc'] = false;

				  	break;
				
		  		default:
		  			@define ('_title', "Bài viết");
				  	@define ('_title_dm', "bài viết");

				  	$config_pr['title'] = 'Danh sách '._title_dm;
				  	$config_pr['full'] = false;
				  	$config_pr['img'] = true;
				  	$config_pr['img-width'] = 300;
				  	$config_pr['img-height'] = 300;
				  	$config_pr['img-ratio'] = 2;
				  	$config_pr['img-gallery'] = false;
				  	$config_pr['noibat'] = false;
				  	$config_pr['mota'] = true;
				  	$config_pr['noidung'] = true;
				  	$config_pr['seo'] = true;
				  	$config_pr['tag'] = false;

				  	$cap1 = false;
					  	$config_cap1['title'] = 'Danh mục '._title_dm.' cấp 1';
					  	$config_cap1['full'] = true;
					  	$config_cap1['img'] = true;
					  	$config_cap1['img-width'] = 300;
					  	$config_cap1['img-height'] = 300;
					  	$config_cap1['img-ratio'] = 2;
					  	$config_cap1['mota'] = false;
					  	$config_cap1['seo'] = true;
					  	$config_cap1['img-qc'] = false;
					  	$config_cap1['img-qc-width'] = 300;
					  	$config_cap1['img-qc-height'] = 300;
					  	$config_cap1['img-qc-ratio'] = 2;

				  	$cap2 = false;
					  	$config_cap2['title'] = 'Danh mục '._title_dm.' cấp 2';
					  	$config_cap2['full'] = true;
					  	$config_cap2['img'] = true;
					  	$config_cap2['img-width'] = 300;
					  	$config_cap2['img-height'] = 300;
					  	$config_cap2['img-ratio'] = 2;
					  	$config_cap2['mota'] = false;
					  	$config_cap2['seo'] = true;
					  	$config_cap2['img-qc'] = false;

				  	$cap3 = false;
					  	$config_cap3['title'] = 'Danh mục '._title_dm.' cấp 3';
					  	$config_cap3['full'] = true;
					  	$config_cap3['img'] = true;
					  	$config_cap3['img-width'] = 300;
					  	$config_cap3['img-height'] = 300;
					  	$config_cap3['img-ratio'] = 2;
					  	$config_cap3['mota'] = false;
					  	$config_cap3['seo'] = true;
					  	$config_cap3['img-qc'] = false;

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

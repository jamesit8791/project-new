<?php
	$type = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";
	switch ($com) {
		case "product":
		  	switch ($type) {
		  		case 'san-pham':
				  	@define ('_title', "Sản phẩm");
				  	@define ('_title_dm', "Sản phẩm");

				  	$config_pr['title'] = 'Danh sách '._title_dm;
				  	$config_pr['full'] = false;
				  	$config_pr['img'] = true;
				  	$config_pr['img-width'] = 600;
				  	$config_pr['img-height'] = 400;
				  	$config_pr['img-ratio'] = 1;
				  	$config_pr['img-gallery'] = true;
				  	$config_pr['mota'] = true;
				  	$config_pr['mota-ckeditor'] = false;
				  	$config_pr['noidung'] = true;
				  	$config_pr['noidung-ckeditor'] = true;
				  	$config_pr['thongtin'] = false;
				  	$config_pr['thongtin-ckeditor'] = false;
				  	$config_pr['khuyenmai'] = false;
				  	$config_pr['khuyenmai-ckeditor'] = false;
				  	$config_pr['chuongtrinh'] = false;
				  	$config_pr['chuongtrinh-ckeditor'] = false;
				  	$config_pr['banggia'] = false;
				  	$config_pr['banggia-ckeditor'] = false;
				  	$config_pr['lichkhoihanh'] = false;
				  	$config_pr['lichkhoihanh-ckeditor'] = false;
				  	$config_pr['seo'] = true;
				  	$config_pr['tag'] = false;
				  	$config_pr['spmoi'] = false;
				  	$config_pr['banchay'] = true;
				  	$config_pr['noibat'] = true;
				  	$config_pr['rating'] = false;
				  	$config_pr['gia'] = true;
				  	$config_pr['giacu'] = true;
				  	$config_pr['masp'] = true;

				  	$cap1 = true;
					  	$config_cap1['title'] = 'Danh mục '._title_dm.' cấp 1';
					  	$config_cap1['full'] = true;
					  	$config_cap1['img'] = true;
					  	$config_cap1['img-width'] = 455;
					  	$config_cap1['img-height'] = 530;
					  	$config_cap1['img-ratio'] = 1;
					  	$config_cap1['mota'] = false;
				  		$config_cap1['mota-ckeditor'] = false;
					  	$config_cap1['seo'] = true;
					  	$config_cap1['noibat'] = true;
					  	$config_cap1['img-qc'] = false;
					  	$config_cap1['img-qc-width'] = 1366;
					  	$config_cap1['img-qc-height'] = 300;
					  	$config_cap1['img-qc-ratio'] = 1;
					  	$config_cap1['color'] = false;
					  	
				  	$cap2 = true;
					  	$config_cap2['title'] = 'Danh mục '._title_dm.' cấp 2';
					  	$config_cap2['full'] = true;
					  	$config_cap2['img'] = true;
					  	$config_cap2['img-width'] = 100;
					  	$config_cap2['img-height'] = 100;
					  	$config_cap2['img-ratio'] = 1;
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
		  			@define ('_title', "Sản phẩm");
				  	@define ('_title_dm', "sản phẩm");

				  	$config_pr['title'] = 'Danh sách '._title_dm;
				  	$config_pr['full'] = false;
				  	$config_pr['img'] = true;
				  	$config_pr['img-width'] = 300;
				  	$config_pr['img-height'] = 300;
				  	$config_pr['img-ratio'] = 2;
				  	$config_pr['img-gallery'] = true;
				  	$config_pr['mota'] = true;
				  	$config_pr['mota-ckeditor'] = false;
				  	$config_pr['noidung'] = true;
				  	$config_pr['noidung-ckeditor'] = true;
				  	$config_pr['thongtin'] = false;
				  	$config_pr['thongtin-ckeditor'] = false;
				  	$config_pr['khuyenmai'] = false;
				  	$config_pr['khuyenmai-ckeditor'] = false;
				  	$config_pr['chuongtrinh'] = false;
				  	$config_pr['chuongtrinh-ckeditor'] = false;
				  	$config_pr['banggia'] = false;
				  	$config_pr['banggia-ckeditor'] = false;
				  	$config_pr['lichkhoihanh'] = false;
				  	$config_pr['lichkhoihanh-ckeditor'] = false;
				  	$config_pr['seo'] = true;
				  	$config_pr['tag'] = false;
				  	$config_pr['spmoi'] = false;
				  	$config_pr['banchay'] = false;
				  	$config_pr['noibat'] = false;
				  	$config_pr['rating'] = false;
				  	$config_pr['gia'] = true;
				  	$config_pr['giacu'] = true;
				  	$config_pr['masp'] = true;

				  	$cap1 = true;
					  	$config_cap1['title'] = 'Danh mục '._title_dm.' cấp 1';
					  	$config_cap1['full'] = true;
					  	$config_cap1['img'] = true;
					  	$config_cap1['img-width'] = 300;
					  	$config_cap1['img-height'] = 300;
					  	$config_cap1['img-ratio'] = 2;
					  	$config_cap1['mota'] = false;
					  	$config_cap1['seo'] = true;
					  	$config_cap1['noibat'] = false;
					  	$config_cap1['img-qc'] = false;
					  	$config_cap1['img-qc-width'] = 300;
					  	$config_cap1['img-qc-height'] = 300;
					  	$config_cap1['img-qc-ratio'] = 2;
					  	$config_cap1['color'] = false;

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

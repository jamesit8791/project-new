<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "capnhat":
		get_gioithieu();
		$template = "setting/item_add";
		break;
	case "save":
		save_gioithieu();
		break;

	default:
		$template = "index";
}

function get_gioithieu(){
	global $d, $item;

	$sql = "select * from #_setting limit 0,1";
	$d->query($sql);
	//if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}

function save_gioithieu(){
	global $d,$config;

	ini_set("memory_limit","256M");
	
	$file_name=images_name($_FILES['file']['name']);
	$file_name1=images_name($_FILES['file1']['name']);
	$file_name2=images_name($_FILES['file2']['name']);
	$file_video=images_name($_FILES['video']['name']);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=setting&act=capnhat");

	if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
		$data['photo'] = $photo;
	}

	if($photo1 = upload_image("file1", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name1)){
		$data['bgtop'] = $photo1;
	}

	if($photo2 = upload_image("file2", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name2)){
		$data['bgcontent'] = $photo2;
	}

	if($video = upload_image("video", 'mp4|MP4', _upload_hinhanh,$file_video)){
		$data['video'] = $video;
	}

	foreach ($config['lang'] as $k => $v){
		$data['ten_'.$k] = (string)$_POST['ten_'.$k];
		$data['diachi_'.$k] = (string)magic_quote($_POST['diachi_'.$k]);
		$data['slogan_'.$k] = (string)magic_quote($_POST['slogan_'.$k]);
		$data['mota1_'.$k] = (string)magic_quote($_POST['mota1_'.$k]);
		$data['mota2_'.$k] = (string)magic_quote($_POST['mota2_'.$k]);
		$data['mota3_'.$k] = (string)magic_quote($_POST['mota3_'.$k]);
		$data['mota4_'.$k] = (string)magic_quote($_POST['mota4_'.$k]);
		$data['mota5_'.$k] = (string)magic_quote($_POST['mota5_'.$k]);
		$data['mota6_'.$k] = (string)magic_quote($_POST['mota6_'.$k]);
	}

	$data['page_sp'] = (int)$_POST['page_sp'];
	$data['page_ne'] = (int)$_POST['page_ne'];
	$data['page_in'] = (int)$_POST['page_in'];
	$data['maufooter'] = (string)$_POST['maufooter'];
	
	$data['link_history'] = (string)$_POST['link_history'];
	$data['email'] = (string)$_POST['email'];
	$data['website'] = (string)$_POST['website'];

	$data['facebook'] = (string)$_POST['facebook'];
	$data['toado'] = (string)$_POST['toado'];
	$data['hotline'] = (string)$_POST['hotline'];
	$data['dienthoai'] = (string)$_POST['dienthoai'];
	$data['link_map'] = (string)$_POST['link_map'];
	$data['thoigian_lv'] = (string)$_POST['thoigian_lv'];

	$data['tags'] = (string)$_POST['tags'];
	$tags = explode(',', (string)$_POST['tags']);
	$tags_list = '';
	foreach ($tags as $k => $v) {
		$tags_list .= changeTitle($v).',';
	}
	$tags_list = substr($tags_list, 0, -1);
	$data['tagskhongdau'] = (string)$tags_list;

	$data['analytics'] = (string)magic_quote($_POST['analytics']);
	$data['vchat'] = (string)magic_quote($_POST['vchat']);

	$data['title'] = (string)$_POST['title'];
	$data['keywords'] = (string)$_POST['keywords'];
	$data['description'] = (string)$_POST['description'];

	$d->reset();
	$d->setTable('setting');
	if($d->update($data))
		header("Location:index.php?com=setting&act=capnhat");
	else
		transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=setting&act=capnhat");
}

?>

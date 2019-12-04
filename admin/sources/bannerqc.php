<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
include_once "type/type_".$com.".php";


switch($act){
	
	case "capnhat":
		get_banner();
		$template = "bannerqc/banner_add";
		break;
	case "save":
		save_banner();
		break;
	
	
	default:
		$template = "index";
}


function get_banner(){
	global $d, $item;

	$sql = "select * from #_photo where com='".$_GET['type']."'";
	$d->query($sql);
	// if($d->num_rows()==0) transfer("Dữ liệu chưa khởi tạo.", "index.php");
	$item = $d->fetch_array();
}

function save_banner(){
	global $d,$config,$config_info;
	
	$sql = "select * from #_photo where com='".$_POST['type']."'";
	$d->query($sql);
	$item = $d->fetch_array();
	$id = $item['id'];
	
	if($id){ 

		foreach ($config['lang'] as $k => $v){
			$file_name = images_name($_FILES['file_'.$k]['name']);

			if($photo = upload_image("file_".$k, 'swf|jpg|gif|png|SWF|JPG|GIF|PNG', _upload_hinhanh,$file_name)){
				$data['photo_'.$k] = $photo;
				$data['thumb_'.$k] = create_thumb($data['photo_'.$k], $config_info['img-width']*$config_info['img-ratio'],$config_info['img-height']*$config_info['img-ratio'], _upload_hinhanh , $file_name,1);	
				$d->setTable('photo');
				$d->setWhere('id', $id);
				$d->select();
				$row = $d->fetch_array();
				delete_file(_upload_hinhanh.$row['photo_'.$k]);
			}
			
			$data['ten_'.$k] = $_POST['ten_'.$k];
		}

		$data['link'] = $_POST['link'];
		$data['com'] = $_POST['type'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$d->setTable('photo');
		$d->setWhere('id', $id);
		if($d->update($data)){
			redirect("index.php?com=bannerqc&act=capnhat&type=".$_POST['type']);
		}
		else{
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=bannerqc&act=capnhat&type=".$_POST['type']);
		}
	}else{ 
		foreach ($config['lang'] as $k => $v){
			$file_name = images_name($_FILES['file_'.$k]['name']);

			if($photo = upload_image("file_".$k, 'swf|jpg|gif|png|SWF|JPG|GIF|PNG', _upload_hinhanh,$file_name)){
				$data['photo_'.$k] = $photo;
				$data['thumb_'.$k] = create_thumb($data['photo_'.$k], $config_info['img-width']*$config_info['img-ratio'],$config_info['img-height']*$config_info['img-ratio'], _upload_hinhanh , $file_name,1);	
			}
			
			if(!$data['photo_'.$k]){
				$data['photo_'.$k] = "" ;
				$data['thumb_'.$k] = "" ;
			}
			
			$data['ten_'.$k] = $_POST['ten_'.$k];
		}
		
		$data['link'] = $_POST['link'];
		$data['com'] = $_POST['type'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$d->setTable('photo');
		if($d->insert($data)){
			redirect("index.php?com=bannerqc&act=capnhat&type=".$_POST['type']);
		}
		else{
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=bannerqc&act=capnhat&type=".$_POST['type']);
		}
	}
}


?>
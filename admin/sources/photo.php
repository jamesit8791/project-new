<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
include_once "type/type_".$com.".php";

switch($act){
	case "man_photo":
		get_photos();
		$template = "photo/photos";
		break;
	case "add_photo":		
		$template = "photo/photo_add";
		break;
	case "edit_photo":
		get_photo();
		$template = "photo/photo_edit";
		break;
	case "save_photo":
		save_photo();
		break;
	case "delete_photo":
		delete_photo();
		break;			
	default:
		$template = "index";
}


function get_photos(){
	global $d, $items, $url_link,$totalRows , $pageSize, $offset,$page;
			
	
	$per_page = 10;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where .= " #_photo ";
	if($_REQUEST['type']!='')
	{
		$where .=" where com='".$_REQUEST['type']."'";
	}
	$where .= "order by stt asc, id desc";

	$sql = "select * from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=photo&act=man_photo&type=".$_REQUEST['type'];
	$paging = pagination($where,$per_page,$page,$url);	

}

function get_photo(){
	global $d, $item, $list_cat;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
	$d->setTable('photo');
	$d->setWhere('id', $id);
	$d->select();
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
	$item = $d->fetch_array();	
}

function save_photo(){
	global $d,$config,$config_info;
	$file_name=fns_Rand_digit(0,9,15);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){
			if($photo = upload_image("img", 'Jpg|jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name)){
				$data['photo_vi'] = $photo;
				$data['thumb_vi'] = create_thumb($data['photo_vi'], $config_info['img-width']*$config_info['img-ratio'],$config_info['img-height']*$config_info['img-ratio'], _upload_hinhanh,$file_name,$config_info['img-ratio']);	
				$d->setTable('photo');
				$d->setWhere('id', $id);
				$d->select();
				if($d->num_rows()>0){
					$row = $d->fetch_array();
					delete_file(_upload_hinhanh.$row['photo_vi']);
					delete_file(_upload_hinhanh.$row['thumb_vi']);
				}
			}
			
			$data['stt'] = $_POST['stt'];
			$data['link'] = $_POST['link'];	
			
			foreach ($config['lang'] as $k => $v){
				$data['ten_'.$k] = $_POST['ten_'.$k];
				$data['mota_'.$k] = magic_quote($_POST['mota_'.$k]);
			}


			$data['com'] = $_POST['type'];	
			$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
			$d->reset();
			$d->setTable('photo');
			$d->setWhere('id', $id);
			if(!$d->update($data)) transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
			redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
			
	}else{ 		
		if($data['photo_vi'] = upload_image("img", 'Jpg|jpg|png|gif|JPG|jpeg|JPEG', _upload_hinhanh,$file_name))
		{	
			$data['thumb_vi'] = create_thumb($data['photo_vi'], $config_info['img-width']*$config_info['img-ratio'],$config_info['img-height']*$config_info['img-ratio'], _upload_hinhanh,$file_name,$config_info['img-ratio']);					
		}
		$data['stt'] = $_POST['stt'];
		$data['link'] = $_POST['link'];	
		foreach ($config['lang'] as $k => $v){
			$data['ten_'.$k] = $_POST['ten_'.$k];
			$data['mota_'.$k] = magic_quote($_POST['mota_'.$k]);
		}

		$data['com'] = $_POST['type'];									
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;																	
		$d->setTable('photo');
		if($d->insert($data)){
			transfer("Đã thêm dữ liệu thành công", "index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
		}else{
			redirect("index.php?com=photo&act=man_photo&type=".$_REQUEST['type']);
		}
	}
}

function delete_photo(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo_vi,thumb_vi from #_photo where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_hinhanh.$row['photo_vi']);
				delete_file(_upload_hinhanh.$row['thumb_vi']);
			}
			$sql = "delete from #_photo where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=photo&act=man_photo&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=photo&act=man_photo&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo_vi,thumb_vi from #_photo where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_hinhanh.$row['photo_vi']);
					delete_file(_upload_hinhanh.$row['thumb_vi']);
				}
				$sql = "delete from #_photo where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=photo&act=man_photo&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=photo&act=man_photo&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}

}
?>
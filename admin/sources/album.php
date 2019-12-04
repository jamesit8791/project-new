<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
include_once "type/type_".$com.".php";

switch($act){
	case "man_list":
		get_lists();
		$template = "album/list/items";
		break;
	case "add_list":		
		$template = "album/list/item_add";
		break;
	case "edit_list":		
		get_list();
		$template = "album/list/item_add";
		break;
	case "save_list":
		save_list();
		break;
	case "delete_list":
		delete_list();
		break;	

	#===================================================
	case "man":
		get_mans();
		$template = "album/man/items";
		break;
	case "add":		
		$template = "album/man/item_add";
		break;
	case "edit":		
		get_man();
		$template = "album/man/item_add";
		break;
	case "save":
		save_man();
		break;
		
	case "delete":
		delete_man();
		break;	

	default:
		$template = "index";
}
	if($_GET['type']=='album'){

		$title_main = "Album";
		$config_images = "true";
		$config_mota= "false";

	}else {

		$title_main = "Album";
		$config_images = "true";

	}

#====================================

function get_mans(){
	global $d, $items, $paging,$page;
	
	
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_album ";

	$where .= " where type='".$_GET['type']."' ";
	
	if($_REQUEST['id_list']!='')
	{
		$where.=" and id_list = ".$_GET['id_list'];
		$link_add .= "&id_list=".$_GET['id_list'];
	}
	
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	$where .=" order by id desc";

	$sql = "select * from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=album&act=man&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);		
	
}

function get_man(){
	global $d, $item,$ds_tags,$ds_photo;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=album&act=man&type=".$_GET['type']);	
	$sql = "select * from #_album where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=album&act=man&type=".$_GET['type']);
	$item = $d->fetch_array();	

	$sql = "select * from #_album_photo where id_album='".$id."' and type='".$_GET['type']."' order by stt,id desc ";
	$d->query($sql);
	$ds_photo = $d->result_array();	
}

function save_man(){
	global $d,$config,$config_info;
	$file_name=images_name($_FILES['file']['name']);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=album&act=man&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	if($id){
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_album,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], $config_info['img-width']*$config_info['img-ratio'],$config_info['img-height']*$config_info['img-ratio'], _upload_album,$file_name,$config_info['img-ratio']);		
			$d->setTable('album');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_album.$row['photo']);	
				delete_file(_upload_album.$row['thumb']);				
			}
		}
		$data['id_list'] = (int)$_POST['id_list'];

		foreach ($config['lang'] as $k => $v){
			$data['ten_'.$k] = $_POST['ten_'.$k];
			$data['mota_'.$k] = magic_quote($_POST['mota_'.$k]);
			$data['noidung_'.$k] = magic_quote($_POST['noidung_'.$k]);
		}

		if($_POST['tenkhongdau']==''){
			$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		}else{
			$data['tenkhongdau'] = $_POST['tenkhongdau'];
		}

		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		
		$data['stt'] = $_POST['stt'];
		
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$data['ngaysua'] = time();
		$d->setTable('album');
		$d->setWhere('id', $id);
		if($d->update($data)){
			if (isset($_FILES['files'])) {
	            for($i=0;$i<count($_FILES['files']['name']);$i++){
	            	if($_FILES['files']['name'][$i]!=''){

						$file['name'] = $_FILES['files']['name'][$i];
						$file['type'] = $_FILES['files']['type'][$i];
						$file['tmp_name'] = $_FILES['files']['tmp_name'][$i];
						$file['error'] = $_FILES['files']['error'][$i];
						$file['size'] = $_FILES['files']['size'][$i];
					    $file_name = images_name($_FILES['files']['name'][$i]);
						$photo = upload_photos($file, 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_album,$file_name);
						$data1['photo'] = $photo;
						$data1['thumb'] = create_thumb($data1['photo'], $config_info['img-width']*$config_info['img-ratio'],$config_info['img-height']*$config_info['img-ratio'], _upload_album,$file_name,$config_info['img-ratio']);
						$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['type'] = $_GET['type'];	
						$data1['id_album'] = $id;
						$data1['hienthi'] = 1;
						$d->setTable('album_photo');
						$d->insert($data1);

					}
				}
	        }

			redirect("index.php?com=album&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		}
		else{
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=album&act=man&type=".$_GET['type']);
		}
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_album,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], $config_info['img-width']*$config_info['img-ratio'],$config_info['img-height']*$config_info['img-ratio'], _upload_album,$file_name,$config_info['img-ratio']);		
		}		
		$data['id_list'] = (int)$_POST['id_list'];	
		foreach ($config['lang'] as $k => $v){
			$data['ten_'.$k] = $_POST['ten_'.$k];
			$data['mota_'.$k] = magic_quote($_POST['mota_'.$k]);
			$data['noidung_'.$k] = magic_quote($_POST['noidung_'.$k]);
		}

		if($_POST['tenkhongdau']==''){
			$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		}else{
			$data['tenkhongdau'] = $_POST['tenkhongdau'];
		}

		$data['type'] = $_GET['type'];
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('album');
		if($d->insert($data))
		{	
			$id = mysql_insert_id();

			if (isset($_FILES['files'])) {
	            for($i=0;$i<count($_FILES['files']['name']);$i++){
	            	if($_FILES['files']['name'][$i]!=''){

						$file['name'] = $_FILES['files']['name'][$i];
						$file['type'] = $_FILES['files']['type'][$i];
						$file['tmp_name'] = $_FILES['files']['tmp_name'][$i];
						$file['error'] = $_FILES['files']['error'][$i];
						$file['size'] = $_FILES['files']['size'][$i];
					    $file_name = images_name($_FILES['files']['name'][$i]);
						$photo = upload_photos($file, 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_album,$file_name);
						$data1['photo'] = $photo;
						$data1['thumb'] = create_thumb($data1['photo'], $config_info['img-width']*$config_info['img-ratio'],$config_info['img-height']*$config_info['img-ratio'], _upload_album,$file_name,$config_info['img-ratio']);
						$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['type'] = $_GET['type'];	
						$data1['id_album'] = $id;
						$data1['hienthi'] = 1;
						$d->setTable('album_photo');
						$d->insert($data1);

					}
				}
	        }

			redirect("index.php?com=album&act=man&type=".$_GET['type']);
		}
		else{
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=album&act=man&type=".$_GET['type']);
		}
	}
}

function delete_man(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_album where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_album.$row['photo']);
				delete_file(_upload_album.$row['thumb']);
			}
			$sql = "delete from #_album where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=album&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=album&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_album where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_album.$row['photo']);
					delete_file(_upload_album.$row['thumb']);
				}
				$sql = "delete from #_album where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=album&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=album&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}
}


#=================List===================

function get_lists(){
	global $d, $items, $paging,$page;

	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_album_list where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_album_list SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_album_list SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}

	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	
	$where = " #_album_list ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	$where .=" order by stt,id desc";

	$sql = "select * from $where $limit";
	$d->query($sql);
	$items = $d->result_array();
    
    $url = "index.php?com=album&act=man_list&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);
}

function get_list(){
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=album&act=man_list&type=".$_GET['type']);
	
	$sql = "select * from #_album_list where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=album&act=man_list&type=".$_GET['type']);
	$item = $d->fetch_array();
}

function save_list(){
	global $d,$config,$config_info;
	$file_name=images_name($_FILES['file']['name']);
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=album&act=man_list&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){

		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_album,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config_info['img-width']*$config_info['img-ratio'],$config_info['img-height']*$config_info['img-ratio'], _upload_album,$file_name,$config_info['img-ratio']);	
			$d->setTable('album_list');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_album.$row['photo']);
				delete_file(_upload_album.$row['thumb']);
			}
		}
	
		foreach ($config['lang'] as $k => $v){
			$data['ten_'.$k] = $_POST['ten_'.$k];
			$data['name_'.$k] = magic_quote($_POST['name_'.$k]);
		}

		if($_POST['tenkhongdau']==''){
			$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		}else{
			$data['tenkhongdau'] = $_POST['tenkhongdau'];
		}


		$data['links'] = $_POST['links'];
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('album_list');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=album&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=album&act=man_list&type=".$_GET['type']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_album,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config_info['img-width']*$config_info['img-ratio'],$config_info['img-height']*$config_info['img-ratio'], _upload_album,$file_name,$config_info['img-ratio']);	
		}
	
		foreach ($config['lang'] as $k => $v){
			$data['ten_'.$k] = $_POST['ten_'.$k];
			$data['name_'.$k] = magic_quote($_POST['name_'.$k]);
		}

		if($_POST['tenkhongdau']==''){
			$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		}else{
			$data['tenkhongdau'] = $_POST['tenkhongdau'];
		}
		$data['links'] = $_POST['links'];
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$data['type'] = $_GET['type'];
		
		$d->setTable('album_list');
		if($d->insert($data))
			redirect("index.php?com=album&act=man_list&type=".$_GET['type']);
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=album&act=man_list&type=".$_GET['type']);
	}
}

function delete_list(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_album_list where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_album.$row['photo']);
				delete_file(_upload_album.$row['thumb']);
			}
			$sql = "delete from #_album_list where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=album&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=album&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_album_list where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_album.$row['photo']);
					delete_file(_upload_album.$row['thumb']);
				}
				$sql = "delete from #_album_list where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=album&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=album&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}
}
#====================================

?>
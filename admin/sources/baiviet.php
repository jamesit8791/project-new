<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
include_once "type/type_".$com.".php";

switch($act){
	case "man_list":
		get_lists();
		$template = "baiviet/list/items";
		break;
	case "add_list":		
		$template = "baiviet/list/item_add";
		break;
	case "edit_list":		
		get_list();
		$template = "baiviet/list/item_add";
		break;
	case "save_list":
		save_list();
		break;
	case "delete_list":
		delete_list();
		break;	
	#===================================================
	case "man_cat":
		get_cats();
		$template = "baiviet/cat/items";
		break;
	case "add_cat":		
		$template = "baiviet/cat/item_add";
		break;
	case "edit_cat":		
		get_cat();
		$template = "baiviet/cat/item_add";
		break;
	case "save_cat":
		save_cat();
		break;
	case "delete_cat":
		delete_cat();
		break;	
	#===================================================
	case "man_item":
		get_items();
		$template = "baiviet/item/items";
		break;
	case "add_item":		
		$template = "baiviet/item/item_add";
		break;
	case "edit_item":		
		get_item();
		$template = "baiviet/item/item_add";
		break;
	case "save_item":
		save_item();
		break;
	case "delete_item":
		delete_item();
		break;	
	#===================================================
	case "man":
		get_mans();
		$template = "baiviet/man/items";
		break;
	case "add":		
		$template = "baiviet/man/item_add";
		break;
	case "edit":		
		get_man();
		$template = "baiviet/man/item_add";
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
#====================================

function get_mans(){
	global $d, $items, $paging,$page;
	
	$per_page = 10;
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_baiviet ";

	$where .= " where type='".$_GET['type']."' ";
	
	if($_REQUEST['id_list']!='')
	{
		$where.=" and id_list = ".$_GET['id_list'];
		$link_add .= "&id_list=".$_GET['id_list'];
	}
	if($_REQUEST['id_cat']!='')
	{
		$where.=" and id_cat = ".$_GET['id_cat'];
		$link_add .= "&id_cat=".$_GET['id_cat'];
	}
	if($_REQUEST['id_item']!='')
	{
		$where.=" and id_item = ".$_GET['id_item'];
		$link_add .= "&id_item=".$_GET['id_item'];
	}
	if($_REQUEST['id_sub']!='')
	{
		$where.=" and id_sub = ".$_GET['id_sub'];
		$link_add .= "&id_sub=".$_GET['id_sub'];
	}

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	$where .=" order by stt asc, id desc";

	$sql = "select * from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=baiviet&act=man&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);		
}

function get_man(){
	global $d, $item,$ds_tags,$ds_photo;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=baiviet&act=man&type=".$_GET['type']);	
	$sql = "select * from #_baiviet where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=baiviet&act=man&type=".$_GET['type']);
	$item = $d->fetch_array();	

	$sql = "select * from #_baiviet_photo where id_baiviet='".$id."' and type='".$_GET['type']."' order by stt asc, id desc ";
	$d->query($sql);
	$ds_photo = $d->result_array();	
}

function save_man(){
	global $d,$config,$config_pr;
	$file_name=images_name($_FILES['file']['name']);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=baiviet&act=man&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	if($id){
		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_baiviet,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], $config_pr['img-width']*$config_pr['img-ratio'],$config_pr['img-height']*$config_pr['img-ratio'], _upload_baiviet,$file_name,1);
			$d->setTable('baiviet');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_baiviet.$row['photo']);	
				delete_file(_upload_baiviet.$row['thumb']);				
			}
		}
		$data['id_list'] = (int)$_POST['id_list'];	
		$data['id_cat'] = (int)$_POST['id_cat'];
		$data['id_item'] = (int)$_POST['id_item'];
		$data['id_sub'] = (int)$_POST['id_sub'];

		foreach ($config['lang'] as $k => $v){
			$data['ten_'.$k] = $_POST['ten_'.$k];
			$data['mota_'.$k] = magic_quote($_POST['mota_'.$k]);
			$data['thongtin_'.$k] = magic_quote($_POST['thongtin_'.$k]);
			$data['noidung_'.$k] = magic_quote($_POST['noidung_'.$k]);
		}

		if($_POST['tenkhongdau']==''){
			$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		}else{
			$data['tenkhongdau'] = $_POST['tenkhongdau'];
		}
		
		$data['text_search'] = changeSearch($_POST['ten_vi']);

		
		$data['link_facebook'] = magic_quote($_POST['link_facebook']);
		$data['link_twitter'] = magic_quote($_POST['link_twitter']);
		$data['link_google'] = magic_quote($_POST['link_google']);
		$data['link_maps'] = magic_quote($_POST['link_maps']);
		$data['iframe_maps'] = magic_quote($_POST['iframe_maps']);
		$data['diachi'] = magic_quote($_POST['diachi']);

		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];

		$data['tags'] = $_POST['tags'];
		$tags = explode(',', $_POST['tags']);
		$tags_list = '';
		foreach ($tags as $k => $v) {
			$tags_list .= changeTitle($v).',';
		}
		$tags_list = substr($tags_list, 0, -1);
		$data['tagskhongdau'] = $tags_list;
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		$d->setTable('baiviet');
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
						$photo = upload_photos($file, 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name);
						$data1['photo'] = $photo;
						$data1['thumb'] = create_thumb($data1['photo'], $config_pr['img-width']*$config_pr['img-ratio'], $config_pr['img-height']*$config_pr['img-ratio'],_upload_baiviet,$file_name,1);
						$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['type'] = $_GET['type'];	
						$data1['id_baiviet'] = $id;
						$data1['hienthi'] = 1;
						$d->setTable('baiviet_photo');
						$d->insert($data1);

					}
				}
	        }
			redirect("index.php?com=baiviet&act=man&id_list=".$_POST['id_list']."&id_cat=".$_POST['id_cat']."&id_item=".$_POST['id_item']."&id_sub=".$_POST['id_sub']."&type=".$_GET['type']."&currentPage=".$_GET['currentPage']);
		}
		else{
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=baiviet&act=man&id_list=".$_POST['id_list']."&id_cat=".$_POST['id_cat']."&id_item=".$_POST['id_item']."&id_sub=".$_POST['id_sub']."&type=".$_GET['type']."&currentPage=".$_GET['currentPage']);
		}
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_baiviet,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], $config_pr['img-width']*$config_pr['img-ratio'],$config_pr['img-height']*$config_pr['img-ratio'], _upload_baiviet,$file_name,1);	
		}		
		$data['id_list'] = (int)$_POST['id_list'];	
		$data['id_cat'] = (int)$_POST['id_cat'];
		$data['id_item'] = (int)$_POST['id_item'];
		$data['id_sub'] = (int)$_POST['id_sub'];

		foreach ($config['lang'] as $k => $v){
			$data['ten_'.$k] = $_POST['ten_'.$k];
			$data['mota_'.$k] = magic_quote($_POST['mota_'.$k]);
			$data['thongtin_'.$k] = magic_quote($_POST['thongtin_'.$k]);
			$data['noidung_'.$k] = magic_quote($_POST['noidung_'.$k]);
		}

		if($_POST['tenkhongdau']==''){
			$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		}else{
			$data['tenkhongdau'] = $_POST['tenkhongdau'];
		}
		
		$data['text_search'] = changeSearch($_POST['ten_vi']);

		$data['link_facebook'] = magic_quote($_POST['link_facebook']);
		$data['link_twitter'] = magic_quote($_POST['link_twitter']);
		$data['link_google'] = magic_quote($_POST['link_google']);
		$data['link_maps'] = magic_quote($_POST['link_maps']);
		$data['iframe_maps'] = magic_quote($_POST['iframe_maps']);
		$data['diachi'] = magic_quote($_POST['diachi']);

		$data['type'] = $_GET['type'];
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['tags'] = $_POST['tags'];
		$tags = explode(',', $_POST['tags']);
		$tags_list = '';
		foreach ($tags as $k => $v) {
			$tags_list .= changeTitle($v).',';
		}
		$tags_list = substr($tags_list, 0, -1);
		$data['tagskhongdau'] = $tags_list;
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('baiviet');
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
						$photo = upload_photos($file, 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name);
						$data1['photo'] = $photo;
						$data1['thumb'] = create_thumb($data1['photo'], $config_pr['img-width']*$config_pr['img-ratio'], $config_pr['img-height']*$config_pr['img-ratio'],_upload_baiviet,$file_name,1);
						$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['type'] = $_GET['type'];	
						$data1['id_baiviet'] = $id;
						$data1['hienthi'] = 1;
						$d->setTable('baiviet_photo');
						$d->insert($data1);
					}
				}
	        }

			redirect("index.php?com=baiviet&act=man&id_list=".$_POST['id_list']."&id_cat=".$_POST['id_cat']."&id_item=".$_POST['id_item']."&id_sub=".$_POST['id_sub']."&type=".$_GET['type']."&currentPage=".$_GET['currentPage']);
		}
		else{
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=baiviet&act=man&id_list=".$_POST['id_list']."&id_cat=".$_POST['id_cat']."&id_item=".$_POST['id_item']."&id_sub=".$_POST['id_sub']."&type=".$_GET['type']."&currentPage=".$_GET['currentPage']);
		}
	}
}

function delete_man(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);

		$d->reset();
		$sql = "select id,photo,thumb from #_baiviet_photo where id_baiviet='".$id."'";
		$d->query($sql);
		$photo_lq = $d->result_array();
		if(count($photo_lq)>0){
			for($i=0;$i<count($photo_lq);$i++){
				delete_file(_upload_baiviet.$photo_lq[$i]['photo']);
				delete_file(_upload_baiviet.$photo_lq[$i]['thumb']);
			}
		}
		$sql = "delete from #_baiviet_photo where id_baiviet='".$id."'";
		$d->query($sql);


		$d->reset();
		$sql = "select id,photo,thumb from #_baiviet where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){

			while($row = $d->fetch_array()){
				delete_file(_upload_baiviet.$row['photo']);
				delete_file(_upload_baiviet.$row['thumb']);
			}
			$sql = "delete from #_baiviet where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=baiviet&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=baiviet&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){

		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);	

			$d->reset();
			$sql = "select id,photo,thumb from #_baiviet_photo where id_baiviet='".$id."'";
			$d->query($sql);
			$photo_lq = $d->result_array();
			if(count($photo_lq)>0){
				for($j=0;$j<count($photo_lq);$j++){
					delete_file(_upload_baiviet.$photo_lq[$j]['photo']);
					delete_file(_upload_baiviet.$photo_lq[$j]['thumb']);
				}
			}
			$sql = "delete from #_baiviet_photo where id_baiviet='".$id."'";
			$d->query($sql);

			$d->reset();
			$sql = "select id,photo,thumb from #_baiviet where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_baiviet.$row['photo']);
					delete_file(_upload_baiviet.$row['thumb']);
				}
				$sql = "delete from #_baiviet where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=baiviet&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=baiviet&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}
}


#=================List===================

function get_lists(){
	global $d, $items, $paging,$page;

	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	
	$where = " #_baiviet_list ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	$where .=" order by stt asc, id desc";

	$sql = "select * from $where $limit";
	$d->query($sql);
	$items = $d->result_array();
    
    $url = "index.php?com=baiviet&act=man_list&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);
}

function get_list(){
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=baiviet&act=man_list&type=".$_GET['type']);
	
	$sql = "select * from #_baiviet_list where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=baiviet&act=man_list&type=".$_GET['type']);
	$item = $d->fetch_array();
}

function save_list(){
	global $d,$config,$config_cap1;
	$file_name=images_name($_FILES['file']['name']);
	$file_quangcao=images_name($_FILES['file']['quangcao']);
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=baiviet&act=man_list&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){

		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config_cap1['img-width']*$config_cap1['img-ratio'],$config_cap1['img-height']*$config_cap1['img-ratio'], _upload_baiviet,$file_name,1);	
			$d->setTable('baiviet_list');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_baiviet.$row['photo']);
				delete_file(_upload_baiviet.$row['thumb']);
			}
		}
		foreach ($config['lang'] as $k => $v){
			$data['ten_'.$k] = $_POST['ten_'.$k];
			$data['name_'.$k] = $_POST['name_'.$k];
			$data['mota_'.$k] = magic_quote($_POST['mota_'.$k]);
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
		
		$d->setTable('baiviet_list');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=baiviet&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=baiviet&act=man_list&type=".$_GET['type']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config_cap1['img-width']*$config_cap1['img-ratio'],$config_cap1['img-height']*$config_cap1['img-ratio'], _upload_baiviet,$file_name,1);	
		}
		foreach ($config['lang'] as $k => $v){
			$data['ten_'.$k] = $_POST['ten_'.$k];
			$data['name_'.$k] = $_POST['name_'.$k];
			$data['mota_'.$k] = magic_quote($_POST['mota_'.$k]);
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
		
		$d->setTable('baiviet_list');
		if($d->insert($data))
			redirect("index.php?com=baiviet&act=man_list&type=".$_GET['type']);
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=baiviet&act=man_list&type=".$_GET['type']);
	}
}

function delete_list(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb,quangcao,quangcao_thumb from #_baiviet_list where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_baiviet.$row['photo']);
				delete_file(_upload_baiviet.$row['thumb']);
			}
			$sql = "delete from #_baiviet_list where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=baiviet&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=baiviet&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb,quangcao,quangcao_thumb from #_baiviet_list where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_baiviet.$row['photo']);
					delete_file(_upload_baiviet.$row['thumb']);
				}
				$sql = "delete from #_baiviet_list where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=baiviet&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=baiviet&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}
}

#=================cat===================

function get_cats(){
	global $d, $items, $paging,$page;

	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$url = "index.php?com=baiviet&act=man_cat&type=".$_GET['type'];
	
	$where = " #_baiviet_cat ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	if($_REQUEST['id_list']!='')
	{
		$where.=" and id_list=".$_REQUEST['id_list'];
		$link_add .= "&id_list=".$_GET['id_list'];
	}

	$where .=" order by stt asc, id desc";

	$sql = "select ten_vi,id,stt,hienthi,id_list from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=baiviet&act=man_cat&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);
}

function get_cat(){
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=baiviet&act=man_cat&type=".$_GET['type']);
	
	$sql = "select * from #_baiviet_cat where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=baiviet&act=man_cat&type=".$_GET['type']);
	$item = $d->fetch_array();
}

function save_cat(){
	global $d,$config,$config_cap2;
	$file_name=images_name($_FILES['file']['name']);
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=baiviet&act=man_cat&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){

		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config_cap2['img-width']*$config_cap2['img-ratio'],$config_cap2['img-height']*$config_cap2['img-ratio'], _upload_baiviet,$file_name,1);	
			$d->setTable('baiviet_cat');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_baiviet.$row['photo']);
				delete_file(_upload_baiviet.$row['thumb']);
			}
		}
		$data['id_list'] = $_POST['id_list'];
		foreach ($config['lang'] as $k => $v){
			$data['ten_'.$k] = $_POST['ten_'.$k];
			$data['mota_'.$k] = magic_quote($_POST['mota_'.$k]);
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
		
		$d->setTable('baiviet_cat');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=baiviet&act=man_cat&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=baiviet&act=man_cat&type=".$_GET['type']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config_cap2['img-width']*$config_cap2['img-ratio'],$config_cap2['img-height']*$config_cap2['img-ratio'], _upload_baiviet,$file_name,1);	
		}
		$data['id_list'] = $_POST['id_list'];
		foreach ($config['lang'] as $k => $v){
			$data['ten_'.$k] = $_POST['ten_'.$k];
			$data['mota_'.$k] = magic_quote($_POST['mota_'.$k]);
		}
		if($_POST['tenkhongdau']==''){
			$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		}else{
			$data['tenkhongdau'] = $_POST['tenkhongdau'];
		}
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['type'] = $_GET['type'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('baiviet_cat');
		if($d->insert($data))
			redirect("index.php?com=baiviet&act=man_cat&type=".$_GET['type']);
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=baiviet&act=man_cat&type=".$_GET['type']);
	}
}

function delete_cat(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_baiviet_cat where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_baiviet.$row['photo']);
				delete_file(_upload_baiviet.$row['thumb']);
			}
			$sql = "delete from #_baiviet_cat where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=baiviet&act=man_cat&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=baiviet&act=man_cat&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_baiviet_cat where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_baiviet.$row['photo']);
					delete_file(_upload_baiviet.$row['thumb']);
				}
				$sql = "delete from #_baiviet_cat where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=baiviet&act=man_cat&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=baiviet&act=man_cat&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}
}
#=================Item===================

function get_items(){
	global $d, $items, $paging,$page;

	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$url = "index.php?com=baiviet&act=man_item&type=".$_GET['type'];
	
	$where = " #_baiviet_item ";
	$where .= " where type='".$_GET['type']."' ";

	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten_vi LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	if($_REQUEST['id_list']!='')
	{
		$where.=" and id_list=".$_REQUEST['id_list'];
		$link_add .= "&id_list=".$_GET['id_list'];
	}
	if($_REQUEST['id_cat']!='')
	{
		$where.=" and id_cat=".$_REQUEST['id_cat'];
		$link_add .= "&id_cat=".$_GET['id_cat'];
	}

	$where .=" order by stt asc, id desc";

	$sql = "select ten_vi,id,stt,hienthi,id_list,id_cat from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=baiviet&act=man_item&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);
}

function get_item(){
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=baiviet&act=man_item&type=".$_GET['type']);
	
	$sql = "select * from #_baiviet_item where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=baiviet&act=man_item&type=".$_GET['type']);
	$item = $d->fetch_array();
}

function save_item(){
	global $d,$config,$config_cap3;
	$file_name=images_name($_FILES['file']['name']);
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=baiviet&act=man_item&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){

		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config_cap3['img-width']*$config_cap3['img-ratio'],$config_cap3['img-height']*$config_cap3['img-ratio'], _upload_baiviet,$file_name,1);	
			$d->setTable('baiviet_item');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_baiviet.$row['photo']);
				delete_file(_upload_baiviet.$row['thumb']);
			}
		}
		$data['id_list'] = $_POST['id_list'];
		$data['id_cat'] = $_POST['id_cat'];
		foreach ($config['lang'] as $k => $v){
			$data['ten_'.$k] = $_POST['ten_'.$k];
			$data['mota_'.$k] = magic_quote($_POST['mota_'.$k]);
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
		
		$d->setTable('baiviet_item');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=baiviet&act=man_item&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=baiviet&act=man_item&type=".$_GET['type']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_baiviet,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config_cap3['img-width']*$config_cap3['img-ratio'],$config_cap3['img-height']*$config_cap3['img-ratio'], _upload_baiviet,$file_name,1);	
		}
		$data['id_list'] = $_POST['id_list'];
		$data['id_cat'] = $_POST['id_cat'];
		foreach ($config['lang'] as $k => $v){
			$data['ten_'.$k] = $_POST['ten_'.$k];
			$data['mota_'.$k] = magic_quote($_POST['mota_'.$k]);
		}
		if($_POST['tenkhongdau']==''){
			$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		}else{
			$data['tenkhongdau'] = $_POST['tenkhongdau'];
		}
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		$data['type'] = $_GET['type'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		
		$d->setTable('baiviet_item');
		if($d->insert($data))
			redirect("index.php?com=baiviet&act=man_item&type=".$_GET['type']);
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=baiviet&act=man_item&type=".$_GET['type']);
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_baiviet_item where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_baiviet.$row['photo']);
				delete_file(_upload_baiviet.$row['thumb']);
			}
			$sql = "delete from #_baiviet_item where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=baiviet&act=man_item&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=baiviet&act=man_item&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_baiviet_item where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_baiviet.$row['photo']);
					delete_file(_upload_baiviet.$row['thumb']);
				}
				$sql = "delete from #_baiviet_item where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=baiviet&act=man_item&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=baiviet&act=man_item&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}
}

#====================================

?>
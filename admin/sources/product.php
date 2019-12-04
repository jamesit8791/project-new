<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
include_once "type/type_".$com.".php";
switch($act){

	case "man_list":
		get_lists();
		$template = "product/list/items";
		break;
	case "add_list":		
		$template = "product/list/item_add";
		break;
	case "edit_list":		
		get_list();
		$template = "product/list/item_add";
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
		$template = "product/cat/items";
		break;
	case "add_cat":		
		$template = "product/cat/item_add";
		break;
	case "edit_cat":		
		get_cat();
		$template = "product/cat/item_add";
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
		$template = "product/item/items";
		break;
	case "add_item":		
		$template = "product/item/item_add";
		break;
	case "edit_item":		
		get_item();
		$template = "product/item/item_add";
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
		$template = "product/man/items";
		break;
	case "add":		
		$template = "product/man/item_add";
		break;
	case "edit":		
		get_man();
		$template = "product/man/item_add";
		break;
	case "save":
		save_man();
		break;
		
	case "delete":
		delete_man();
		break;	
	#============================================================
	case "duyetbl":
		get_duyetbl();
		$template = "product/duyetbl";
		break;
	case "delete_binhluan":
		delete_binhluan();
		$template = "product/duyetbl";
		break;
	default:
		$template = "index";
}

#====================================

function get_mans(){
	global $d, $items, $paging,$page;

	$per_page = 30; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_product ";
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

	if($_SESSION['login']['role']==1)
	{
		$where.=" and adminup = ".$_SESSION['login']['username'];
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

	$url = "index.php?com=product&act=man&type=".$_GET['type']."".$link_add."&type=".$_GET['type'];
	$paging = pagination($where,$per_page,$page,$url);		
	
}

function get_man(){
	global $d, $item,$ds_tags,$ds_photo;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man&type=".$_GET['type']);	
	$sql = "select * from #_product where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man&type=".$_GET['type']);
	$item = $d->fetch_array();	

	$sql = "select * from #_product_photo where id_product='".$id."' and type='".$_GET['type']."' order by stt asc, id desc ";
	$d->query($sql);
	$ds_photo = $d->result_array();	
}

function save_man(){
	global $d,$config,$config_pr;
	$file_name=images_name($_FILES['file']['name']);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	if($id){

		$id =  themdau($_POST['id']);
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product,$file_name)){
			$data['photo'] = $photo;	
			$data['thumb'] = create_thumb($data['photo'], $config_pr['img-width']*$config_pr['img-ratio'], $config_pr['img-height']*$config_pr['img-ratio'], _upload_product,$file_name,1);		
			$d->setTable('product');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
		}

	    $data['id_list'] = (int)$_POST['id_list'];	
		$data['id_cat'] = (int)$_POST['id_cat'];
		$data['id_item'] = (int)$_POST['id_item'];
		$data['id_sub'] = (int)$_POST['id_sub'];

		foreach ($config['lang'] as $k => $v){
			$data['ten_'.$k] = $_POST['ten_'.$k];
			$data['name_'.$k] = $_POST['name_'.$k];
			$data['mota_'.$k] = magic_quote($_POST['mota_'.$k]);
			$data['thongtin_'.$k] = magic_quote($_POST['thongtin_'.$k]);
			$data['noidung_'.$k] = magic_quote($_POST['noidung_'.$k]);
			$data['khuyenmai_'.$k] = magic_quote($_POST['khuyenmai_'.$k]);
			$data['chuongtrinh_'.$k] = magic_quote($_POST['chuongtrinh_'.$k]);
			$data['banggia_'.$k] = magic_quote($_POST['banggia_'.$k]);
			$data['lichkhoihanh_'.$k] = magic_quote($_POST['lichkhoihanh_'.$k]);
		}

		if($_POST['tenkhongdau']==''){
			$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		}else{
			$data['tenkhongdau'] = $_POST['tenkhongdau'];
		}
		
		$data['text_search'] = changeSearch($_POST['ten_vi']);

		$data['rating'] = $_POST['rating'];
		$data['video'] = $_POST['video'];
		$data['color'] = $_POST['color'];	
		$data['size'] = $_POST['size'];


		$data['giaban'] = str_replace(',','',$_POST['giaban']);
		$data['giacu'] = str_replace(',','',$_POST['giacu']);
		$data['masp'] = $_POST['masp'];
		

		$data['tags'] = $_POST['tags'];
		$tags = explode(',', $_POST['tags']);
		$tags_list = '';
		foreach ($tags as $k => $v) {
			$tags_list .= changeTitle($v).',';
		}
		$tags_list = substr($tags_list, 0, -1);
		$data['tagskhongdau'] = $tags_list;
		
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];
		
		$data['stt'] = $_POST['stt'];
		
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$data['ngaysua'] = time();
		$d->setTable('product');
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
						$photo = upload_photos($file, 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name);
						$data1['photo'] = $photo;
						$data1['thumb'] = create_thumb($data1['photo'], $config_pr['img-width']*$config_pr['img-ratio'], $config_pr['img-height']*$config_pr['img-ratio'],_upload_product,$file_name,1);
						$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['type'] = $_GET['type'];	
						$data1['id_product'] = $id;
						$data1['hienthi'] = 1;
						$d->setTable('product_photo');
						$d->insert($data1);

					}
				}
	        }

			redirect("index.php?com=product&act=man&id_list=".$_POST['id_list']."&id_cat=".$_POST['id_cat']."&id_item=".$_POST['id_item']."&id_sub=".$_POST['id_sub']."&type=".$_GET['type']."&currentPage=".$_GET['currentPage']);
		}
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&id_list=".$_POST['id_list']."&id_cat=".$_POST['id_cat']."&id_item=".$_POST['id_item']."&id_sub=".$_POST['id_sub']."&type=".$_GET['type']."&currentPage=".$_GET['currentPage']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product,$file_name)){
			$data['photo'] = $photo;		
			$data['thumb'] = create_thumb($data['photo'], $config_pr['img-width']*$config_pr['img-ratio'], $config_pr['img-height']*$config_pr['img-ratio'],_upload_product,$file_name,1);	
		}		
		
	    $data['id_list'] = (int)$_POST['id_list'];	
		$data['id_cat'] = (int)$_POST['id_cat'];
		$data['id_item'] = (int)$_POST['id_item'];
		$data['id_sub'] = (int)$_POST['id_sub'];

		foreach ($config['lang'] as $k => $v){
			$data['ten_'.$k] = $_POST['ten_'.$k];
			$data['name_'.$k] = $_POST['name_'.$k];
			$data['mota_'.$k] = magic_quote($_POST['mota_'.$k]);
			$data['thongtin_'.$k] = magic_quote($_POST['thongtin_'.$k]);
			$data['noidung_'.$k] = magic_quote($_POST['noidung_'.$k]);
			$data['khuyenmai_'.$k] = magic_quote($_POST['khuyenmai_'.$k]);
			$data['chuongtrinh_'.$k] = magic_quote($_POST['chuongtrinh_'.$k]);
			$data['banggia_'.$k] = magic_quote($_POST['banggia_'.$k]);
			$data['lichkhoihanh_'.$k] = magic_quote($_POST['lichkhoihanh_'.$k]);
		}
		if($_POST['tenkhongdau']==''){
			$data['tenkhongdau'] = changeTitle($_POST['ten_vi']);
		}else{
			$data['tenkhongdau'] = $_POST['tenkhongdau'];
		}
		$data['text_search'] = changeSearch($_POST['ten_vi']);
		
		$data['rating'] = $_POST['rating'];
		$data['video'] = $_POST['video'];
		$data['color'] = $_POST['color'];
		$data['size'] = $_POST['size'];
		
		$data['giacu'] = str_replace(',','',$_POST['giacu']);
		$data['giaban'] = str_replace(',','',$_POST['giaban']);
		$data['masp'] = $_POST['masp'];
		$data['adminup'] = $_SESSION['login']['username'];	

		$data['tags'] = $_POST['tags'];
		$tags = explode(',', $_POST['tags']);
		$tags_list = '';
		foreach ($tags as $k => $v) {
			$tags_list .= changeTitle($v).',';
		}
		$tags_list = substr($tags_list, 0, -1);
		$data['tagskhongdau'] = $tags_list;
		
		$data['title'] = $_POST['title'];
		$data['keywords'] = $_POST['keywords'];
		$data['description'] = $_POST['description'];

		$data['type'] = $_GET['type'];
		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('product');
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
						$photo = upload_photos($file, 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name);
						$data1['photo'] = $photo;
						$data1['thumb'] = create_thumb($data1['photo'], $config_pr['img-width']*$config_pr['img-ratio'], $config_pr['img-height']*$config_pr['img-ratio'],_upload_product,$file_name,1);
						$data1['stt'] = (int)$_POST['stthinh'][$i];
						$data1['type'] = $_GET['type'];	
						$data1['id_product'] = $id;
						$data1['hienthi'] = 1;
						$d->setTable('product_photo');
						$d->insert($data1);
					}
				}
	        }
	        transfer("Dữ liệu đã được lưu", "index.php?com=product&act=man&id_list=".$_POST['id_list']."&id_cat=".$_POST['id_cat']."&id_item=".$_POST['id_item']."&id_sub=".$_POST['id_sub']."&type=".$_GET['type']."&currentPage=".$_GET['currentPage']);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man&id_list=".$_POST['id_list']."&id_cat=".$_POST['id_cat']."&id_item=".$_POST['id_item']."&id_sub=".$_POST['id_sub']."&type=".$_GET['type']."&currentPage=".$_GET['currentPage']);
	}
}

function delete_man(){
	global $d;
	

	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);

		$d->reset();
		$sql = "select id,photo,thumb from #_product_photo where id_product='".$id."'";
		$d->query($sql);
		$photo_lq = $d->result_array();
		if(count($photo_lq)>0){
			for($i=0;$i<count($photo_lq);$i++){
				delete_file(_upload_product.$photo_lq[$i]['photo']);
				delete_file(_upload_product.$photo_lq[$i]['thumb']);
			}
		}
		$sql = "delete from #_product_photo where id_product='".$id."'";
		$d->query($sql);


		$d->reset();
		$sql = "select id,photo,thumb from #_product where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){

			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_product where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=product&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){

		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);	

			$d->reset();
			$sql = "select id,photo,thumb from #_product_photo where id_product='".$id."'";
			$d->query($sql);
			$photo_lq = $d->result_array();
			if(count($photo_lq)>0){
				for($j=0;$j<count($photo_lq);$j++){
					delete_file(_upload_product.$photo_lq[$j]['photo']);
					delete_file(_upload_product.$photo_lq[$j]['thumb']);
				}
			}
			$sql = "delete from #_product_photo where id_product='".$id."'";
			$d->query($sql);

			$d->reset();
			$sql = "select id,photo,thumb from #_product where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
				}
				$sql = "delete from #_product where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=product&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}


}


#=================List===================

function get_lists(){
	global $d, $items, $paging,$page;

	$per_page = 30; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	
	$where = " #_product_list ";
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
    
    $url = "index.php?com=product&act=man_list&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);
}

function get_list(){
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_list&type=".$_GET['type']);
	
	$sql = "select * from #_product_list where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_list&type=".$_GET['type']);
	$item = $d->fetch_array();
}

function save_list(){
	global $d,$config,$config_cap1;
	$file_name=images_name($_FILES['file']['name']);
	$file_quangcao=images_name($_FILES['quangcao']['name']);
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_list&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){

		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config_cap1['img-width']*$config_cap1['img-ratio'], $config_cap1['img-height']*$config_cap1['img-ratio'], _upload_product,$file_name,2);	
			$d->setTable('product_list');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);
			}
		}

		if($quangcao = upload_image("quangcao", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_quangcao)){
			$data['quangcao'] = $quangcao;
			$data['quangcao_thumb'] = create_thumb($data['quangcao'], $config_cap1['img-width']*$config_cap1['img-ratio'], $config_cap1['img-height']*$config_cap1['img-ratio'], _upload_product,$file_quangcao,1);	
			$d->setTable('product_list');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['quangcao']);
				delete_file(_upload_product.$row['quangcao_thumb']);
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
		$data['mau'] = $_POST['mau'];

		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaysua'] = time();
		
		$d->setTable('product_list');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=product&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_list&type=".$_GET['type']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config_cap1['img-width']*$config_cap1['img-ratio'], $config_cap1['img-height']*$config_cap1['img-ratio'], _upload_product,$file_name,2);	
		}

		if($quangcao = upload_image("quangcao", 'jpg|png|gif|JPG|jpeg|JPEG', _upload_product,$file_quangcao)){
			$data['quangcao'] = $quangcao;	
			$data['quangcao_thumb'] = create_thumb($data['quangcao'], $config_cap1['img-width']*$config_cap1['img-ratio'], $config_cap1['img-height']*$config_cap1['img-ratio'], _upload_product,$file_quangcao,2);		
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
		$data['mau'] = $_POST['mau'];

		$data['stt'] = $_POST['stt'];
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$data['type'] = $_GET['type'];

		$d->setTable('product_list');
		if($d->insert($data))
			redirect("index.php?com=product&act=man_list&type=".$_GET['type']);
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_list&type=".$_GET['type']);
	}
}

function delete_list(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb,quangcao,quangcao_thumb from #_product_list where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
				delete_file(_upload_product.$row['quangcao']);
				delete_file(_upload_product.$row['quangcao_thumb']);
			}
			$sql = "delete from #_product_list where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=product&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb,quangcao,quangcao_thumb from #_product_list where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
					delete_file(_upload_product.$row['quangcao']);
					delete_file(_upload_product.$row['quangcao_thumb']);
				}
				$sql = "delete from #_product_list where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=product&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_list&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}
}

#=================cat===================

function get_cats(){
	global $d, $items, $paging,$page;

	$per_page = 30; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$url = "index.php?com=product&act=man_cat&type=".$_GET['type'];
	
	$where = " #_product_cat ";
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

	$sql = "select * from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=product&act=man_cat&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);
}

function get_cat(){
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_cat&type=".$_GET['type']);
	
	$sql = "select * from #_product_cat where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_cat&type=".$_GET['type']);
	$item = $d->fetch_array();
}

function save_cat(){
	global $d,$config,$config_cap2;
	$file_name=images_name($_FILES['file']['name']);
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_cat&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){

		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config_cap2['img-width']*$config_cap2['img-ratio'], $config_cap2['img-height']*$config_cap2['img-ratio'], _upload_product,$file_name,1);	
			$d->setTable('product_cat');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);
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
		
		$d->setTable('product_cat');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=product&act=man_cat&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_cat&type=".$_GET['type']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config_cap2['img-width']*$config_cap2['img-ratio'], $config_cap2['img-height']*$config_cap2['img-ratio'], _upload_product,$file_name,1);	
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

		$d->setTable('product_cat');
		if($d->insert($data))
			redirect("index.php?com=product&act=man_cat&type=".$_GET['type']);
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_cat&type=".$_GET['type']);
	}
}

function delete_cat(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_product_cat where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_product_cat where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=product&act=man_cat&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_cat&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_product_cat where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
				}
				$sql = "delete from #_product_cat where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=product&act=man_cat&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_cat&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}
}
#=================Item===================

function get_items(){
	global $d, $items, $paging,$page;

	if($_REQUEST['hienthi']!='')
	{
		$id_up = $_REQUEST['hienthi'];
		$sql_sp = "SELECT id,hienthi FROM table_product_item where id='".$id_up."' ";
		$d->query($sql_sp);
		$cats= $d->result_array();
		$hienthi=$cats[0]['hienthi'];
		if($hienthi==0)
		{
		$sqlUPDATE_ORDER = "UPDATE table_product_item SET hienthi =1 WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
		}
		else
		{
		$sqlUPDATE_ORDER = "UPDATE table_product_item SET hienthi =0  WHERE  id = ".$id_up."";
		$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	}	
	}

	$per_page = 30; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	$url = "index.php?com=product&act=man_item&type=".$_GET['type'];
	
	$where = " #_product_item ";
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

	$url = "index.php?com=product&act=man_item&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);
}

function get_item(){
	global $d, $item;

	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
	transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_item&type=".$_GET['type']);
	
	$sql = "select * from #_product_item where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=product&act=man_item&type=".$_GET['type']);
	$item = $d->fetch_array();
}

function save_item(){
	global $d,$config,$config_cap3;
	$file_name=images_name($_FILES['file']['name']);
	
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_item&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	if($id){

		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config_cap3['img-width']*$config_cap3['img-ratio'], $config_cap3['img-height']*$config_cap3['img-ratio'], _upload_product,$file_name,1);	
			$d->setTable('product_item');
			$d->setWhere('id', $id);
			$d->select();
			if($d->num_rows()>0){
				$row = $d->fetch_array();
				delete_file(_upload_product.$row['photo']);
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
		
		$d->setTable('product_item');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=product&act=man_item&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=product&act=man_item&type=".$_GET['type']);
	}else{
		if($photo = upload_image("file", 'jpg|png|gif|PNG|GIF|JPG|JPEG|jpeg', _upload_product,$file_name)){
			$data['photo'] = $photo;
			$data['thumb'] = create_thumb($data['photo'], $config_cap3['img-width']*$config_cap3['img-ratio'], $config_cap3['img-height']*$config_cap3['img-ratio'], _upload_product,$file_name,1);	
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
		
		$d->setTable('product_item');
		if($d->insert($data))
			redirect("index.php?com=product&act=man_item&type=".$_GET['type']);
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=product&act=man_item&type=".$_GET['type']);
	}
}

function delete_item(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id,photo,thumb from #_product_item where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			while($row = $d->fetch_array()){
				delete_file(_upload_product.$row['photo']);
				delete_file(_upload_product.$row['thumb']);
			}
			$sql = "delete from #_product_item where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=product&act=man_item&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=product&act=man_item&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id,photo,thumb from #_product_item where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				while($row = $d->fetch_array()){
					delete_file(_upload_product.$row['photo']);
					delete_file(_upload_product.$row['thumb']);
				}
				$sql = "delete from #_product_item where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=product&act=man_item&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=product&act=man_item&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}
}

#====================================



?>
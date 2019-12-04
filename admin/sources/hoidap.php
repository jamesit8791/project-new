<?php	if(!defined('_source')) die("Error");
switch($act){
	
	#===================================================
	case "man":
		get_mans();
		$template = "hoidap/man/items";
		break;
	case "add":		
		$template = "hoidap/man/item_add";
		break;
	case "edit":		
		get_man();
		$template = "hoidap/man/item_add";
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
$title_main = "Hỏi đáp";
			

#====================================

function get_mans(){
	global $d, $items, $paging,$page;
	
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_hoidap ";

	$where .= " where id!=0 ";
	
	if($_REQUEST['keyword']!='')
	{
		$keyword=addslashes($_REQUEST['keyword']);
		$where.=" and ten LIKE '%$keyword%'";
		$link_add .= "&keyword=".$_GET['keyword'];
	}
	$where .=" order by id desc";

	$sql = "select * from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=hoidap&act=man&type=".$_GET['type']."".$link_add;
	$paging = pagination($where,$per_page,$page,$url);		
	
}

function get_man(){
	global $d, $item,$ds_tags;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=hoidap&act=man&type=".$_GET['type']);	
	$sql = "select * from #_hoidap where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=hoidap&act=man&type=".$_GET['type']);
	$item = $d->fetch_array();	
}

function save_man(){
	global $d;
	$file_name=images_name($_FILES['file']['name']);

	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=hoidap&act=man&type=".$_GET['type']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	if($id){
		$id =  themdau($_POST['id']);
		
		$data['ten'] = $_POST['ten'];
		$data['mota'] = $_POST['mota'];
		$data['noidung'] = $_POST['noidung'];
		$data['noidung_traloi'] = magic_quote($_POST['noidung_traloi']);	

		$data['email'] = $_POST['email'];
		$data['dienthoai'] = $_POST['dienthoai'];
		
		$data['stt'] = $_POST['stt'];
		
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		
		$data['ngaysua'] = time();
		$d->setTable('hoidap');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=hoidap&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=hoidap&act=man&type=".$_GET['type']);
	}else{
		$data['ten'] = $_POST['ten'];
		$data['mota'] = $_POST['mota'];
		$data['noidung'] = $_POST['noidung'];
		$data['noidung_traloi'] = magic_quote($_POST['noidung_traloi']);	

		$data['email'] = $_POST['email'];
		$data['dienthoai'] = $_POST['dienthoai'];
		
		$data['stt'] = $_POST['stt'];
		
		$data['hienthi'] = isset($_POST['hienthi']) ? 1 : 0;
		$data['ngaytao'] = time();
		$d->setTable('hoidap');
		if($d->insert($data))
		{			
			redirect("index.php?com=hoidap&act=man&type=".$_GET['type']);
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=hoidap&act=man&type=".$_GET['type']);
	}
}

function delete_man(){
	global $d;
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "select id from #_hoidap where id='".$id."'";
		$d->query($sql);
		if($d->num_rows()>0){
			$sql = "delete from #_hoidap where id='".$id."'";
			$d->query($sql);
		}
		if($d->query($sql))
			redirect("index.php?com=hoidap&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=hoidap&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "select id from #_hoidap where id='".$id."'";
			$d->query($sql);
			if($d->num_rows()>0){
				$sql = "delete from #_hoidap where id='".$id."'";
				$d->query($sql);
			}
		}
		redirect("index.php?com=hoidap&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=hoidap&act=man&curPage=".$_REQUEST['curPage']."&type=".$_GET['type']);
	}
}


?>
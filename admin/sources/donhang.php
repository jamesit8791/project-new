<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
$id=$_REQUEST['id'];


switch($act){

	case "man":
		get_items();
		$template = "donhang/items";
		break;
	case "add":		
		$template = "donhang/item_add";
		break;
	case "edit":		
		get_item();
		$template = "donhang/item_add";
		break;
	case "save":
		save_item();
		break;
	case "delete":
		delete_item();
		break;	
	default:
		$template = "index";
}

#====================================
function get_items(){
	global $d, $items, $paging;
	
	$sql = "select * from #_donhang";	
	if(isset($_REQUEST['keyword']))
	{
		
		$keyword=$_REQUEST['keyword'];
		$price=(int)$_REQUEST['price'];
		$sql_price='';
			if($price==1)
				$sql_price=" and tonggia < 3000000";
			elseif($price==2)
				$sql_price=" and tonggia >= 3000000 and tonggia < 7000000";
			elseif($price==3)
				$sql_price=" and tonggia >= 7000000 and tonggia < 10000000";
			elseif($price==4)
				$sql_price=" and tonggia >= 10000000";
				
		$sql.=" where ( (hoten LIKE '%$keyword%') OR (madonhang LIKE '%$keyword%')) $sql_price";
	}	
	if($price!=''){	
		$sql.=" order by tonggia asc";
	} else {
		$sql.=" order by id desc";
	}
	
	$d->query($sql);
	$items = $d->result_array();
	
	$curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
	$url="index.php?com=order&act=man";
	$maxR=20;
	$maxP=20;
	$paging=paging($items, $url, $curPage, $maxR, $maxP);
	$items=$paging['source'];
}

function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=order&act=man");
	
	$sql = "select * from #_donhang where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=order&act=man");
	$item = $d->fetch_array();	
}

function save_item(){
	global $d;
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=order&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	
	if($id){
		$id =  themdau($_POST['id']);			
		
		$d->reset();
		$sql = "select * from #_user where username='".$_SESSION['login']['username']."'";
		$d->query($sql);
		$thanhvien = $d->fetch_array();
		$quyen = explode('|',$thanhvien['donhang']);
		
		if(!in_array('3',$quyen)){
			transfer("Bạn không có quyền sửa mục này ! ", "index.php?com=order&act=man");
		}
	
		$data['ghichu'] = $_POST['ghichu'];
		$data['trangthai'] = $_POST['trangthai'];
		$data['thanhtoan'] = $_POST['thanhtoan_1'];				
		$d->setTable('donhang');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=order&act=man&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=order&act=man");
	}else{
			
				
		$data['ghichu'] = $_POST['ghichu'];
		$data['trangthai'] = $_POST['trangthai'];
		$data['thanhtoan'] = $_POST['thanhtoan_1'];		
		$d->setTable('donhang');
		if($d->insert($data))
			redirect("index.php?com=order&act=man");
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=order&act=man");
	}
}

function delete_item(){
	global $d;
	
	
	$d->reset();
		$sql = "select * from #_user where username='".$_SESSION['login']['username']."'";
		$d->query($sql);
		$thanhvien = $d->fetch_array();
		$quyen = explode('|',$thanhvien['donhang']);
		
		if(!in_array('2',$quyen)){
			transfer("Bạn không có quyền xóa mục này ! ", "index.php?com=order&act=man");
		}
		
		
	if($_REQUEST['id_cat']!='')
	{ $id_catt="&id_cat=".$_REQUEST['id_cat'];
	}
	if($_REQUEST['curPage']!='')
	{ $id_catt.="&curPage=".$_REQUEST['curPage'];
	}
	
	
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "delete from #_donhang where id='".$id."'";
		$d->query($sql);
		if($d->query($sql))
			redirect("index.php?com=order&act=man".$id_catt."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=order&act=man");
	}else transfer("Không nhận được dữ liệu", "index.php?com=order&act=man");
}
?>
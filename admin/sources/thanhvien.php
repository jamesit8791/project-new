<?php	if(!defined('_source')) die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch($act){
	case "man":
		get_items();
		$template = "thanhvien/items";
		break;
	case "add":
		$template = "thanhvien/item_add";
		break;
	case "edit":
		get_item();
		$template = "thanhvien/item_add";
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

//////////////////
function get_items(){
	global $d, $items, $paging ,$page;
	
	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where = " #_thanhvien order by stt asc, id desc ";

	$sql = "select * from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=thanhvien&act=man";
	$paging = pagination($where,$per_page,$page,$url);
}

function get_item(){
	global $d, $item;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=thanhvien&act=man");
	
	$sql = "select * from #_thanhvien where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=thanhvien&act=man");
	$item = $d->fetch_array();
}

function save_item(){
	global $d;
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=thanhvien&act=man");
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";

	if($id){ // cap nhat
		$id =  themdau($_POST['id']);
		
		$data['email'] = $_POST['email'];
		if($_POST['oldpassword']!=""){
			$data['password'] = md5($_POST['oldpassword']);
		}
		$data['username'] = $_POST['username'];
		$data['ten'] = $_POST['ten'];
		$data['sex'] = $_POST['sex'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['diachi'] = $_POST['diachi'];
		$data['country'] = $_POST['country'];
		$data['city'] = $_POST['city'];
		$data['stt'] = $_POST['stt'];
		$d->reset();
		$d->setTable('thanhvien');
		$d->setWhere('id', $id);
		if($d->update($data))
			transfer("Dữ liệu đã được cập nhật", "index.php?com=thanhvien&act=man");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=thanhvien&act=man");
	
	}else{ // them moi
	
		// kiem tra ten trung
		$d->reset();
		$d->setTable('thanhvien');
		$d->setWhere('email', $_POST['email']);
		$d->select();
		if($d->num_rows()>0) transfer("Email đăng nhập này đã có.<br>Xin chọn tên khác.", "index.php?com=thanhvien&act=edit&id=".$id);
		
		if($_POST['oldpassword']=="") transfer("Chưa nhập mật khẩu", "index.php?com=thanhvien&act=add");
		
		$data['username'] = $_POST['username'];
		$data['password'] = md5($_POST['oldpassword']);
		$data['email'] = $_POST['email'];
		$data['ten'] = $_POST['ten'];
		$data['sex'] = $_POST['sex'];
		$data['dienthoai'] = $_POST['dienthoai'];
		$data['diachi'] = $_POST['diachi'];
		$data['country'] = $_POST['country'];
		$data['city'] = $_POST['city'];
		$data['stt'] = $_POST['stt'];
		$d->setTable('thanhvien');
		if($d->insert($data)){

			transfer("Dữ liệu đã được lưu", "index.php?com=thanhvien&act=man");
		}
		else
			transfer("Lưu dữ liệu bị lỗi", "index.php?com=thanhvien&act=man");
	}
}

function delete_item(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		
		// kiem tra
		$d->reset();
		$d->setTable('thanhvien');
		$d->setWhere('id', $id);
		$d->select();
		if($d->num_rows()>0){
			$row = $d->fetch_array();
			$sql = "delete from #_thanhvien where id='".$id."'";
			if($d->query($sql))
				transfer("Dữ liệu đã được xóa", "index.php?com=thanhvien&act=man");
			else
				transfer("Xóa dữ liệu bị lỗi", "index.php?com=thanhvien&act=man");
		}
		
		
	}else transfer("Không nhận được dữ liệu", "index.php?com=thanhvien&act=man");
}

?>
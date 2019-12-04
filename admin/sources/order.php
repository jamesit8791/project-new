<?php	if(!defined('_source')) die("Error");
$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

$urldanhmuc ="";
$urldanhmuc.= (isset($_REQUEST['id_user'])) ? "&id_user=".addslashes($_REQUEST['id_user']) : "";
$urldanhmuc.= (isset($_REQUEST['datefm'])) ? "&id_user=".addslashes($_REQUEST['datefm']) : "";
$urldanhmuc.= (isset($_REQUEST['dateto'])) ? "&id_user=".addslashes($_REQUEST['dateto']) : "";
$urldanhmuc.= (isset($_REQUEST['status'])) ? "&status=".addslashes($_REQUEST['status']) : "";

$id=$_REQUEST['id'];
switch($act){

	case "man":
		get_items();
		$template = "order/items";
		break;
	case "add":		
		$template = "order/item_add";
		break;
	case "edit":		
		get_item();
		$template = "order/item_add";
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
	global $d, $items, $page,$paging;
	
	if(!empty($_POST)){
		$multi=$_REQUEST['multi'];
		$id_array=$_POST['iddel'];
		$count=count($id_array);				
		if($multi=='del'){
			for($i=0;$i<$count;$i++){
				$sql = "delete from #_order_detail where id_order 	='".$id_array[$i]."'";
				$d->query($sql);
		
				$sql = "delete from table_order where id = '".$id_array[$i]."'";
				mysql_query($sql) or die("Not query sqlUPDATE_ORDER");			
							
			}
			redirect("index.php?com=order&act=man&id_tinhtrang=".$_REQUEST['id_tinhtrang']);			
		}		
	}
	

	$per_page = 10; // Set how many records do you want to display per page.
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;
	
	$where .= " #_order where id<>0 ";
	if($_REQUEST['loai']==1){
		if($_REQUEST['madonhang']!=''){
			$madonhang = $_REQUEST['madonhang'];	
			$where .= " and madonhang like '%$madonhang%'";
			
		}
		if($_REQUEST['hoten']!=''){
			$hoten = $_REQUEST['hoten'];	
			$where .= " and hoten like '%$hoten%'";
			
		}
		if($_REQUEST['dienthoai']!=''){
			$dienthoai = $_REQUEST['dienthoai'];	
			$where .= " and dienthoai like '%$dienthoai%'";
			
		}
	}elseif($_REQUEST['loai']==2){
		if($_REQUEST['madonhang']!=''){
			$madonhang = $_REQUEST['madonhang'];	
			$where .= " and madonhang like '%$madonhang%'";
			
		}
		if($_REQUEST['hoten']!=''){
			$hoten = $_REQUEST['hoten'];	
			$where .= " and hoten like '%$hoten%'";
			
		}
		if($_REQUEST['dienthoai']!=''){
			$dienthoai = $_REQUEST['dienthoai'];	
			$where .= " and dienthoai like '%$dienthoai%'";
			
		}
		if($_REQUEST['id_tinhtrang']!='' && $_REQUEST['id_tinhtrang']!=0){
			$trangthai = $_REQUEST['id_tinhtrang'];	
			$where .= " and trangthai='$trangthai'";
			
		}
		if($_REQUEST['ngaybd']!=''){
			$ngaybd = strtotime(str_replace('/','-',$_REQUEST['ngaybd']).' 00:00');
			$where .= " and ngaytao >= '$ngaybd'";
		}
		if($_REQUEST['ngaykt']!=''){
			$ngaykt = strtotime(str_replace('/','-',$_REQUEST['ngaykt']).' 23:59');
			$where .= " and ngaytao <= '$ngaykt'";
		}

		if($_REQUEST['giatu']!=''){
			$giatu = str_replace(',','',$_REQUEST['giatu']);
			$where .= " and tonggia >= '$giatu'";
		}
		if($_REQUEST['giaden']!=''){
			$giaden = str_replace(',','',$_REQUEST['giaden']);	
			$where .= " and tonggia <= '$giaden'";
		}
	}else{
		if($_REQUEST['id_tinhtrang']!='' && $_REQUEST['id_tinhtrang']!=0){
			$trangthai = $_REQUEST['id_tinhtrang'];	
			$where .= " and trangthai='$trangthai'";
			
		}
	}
	
	$where .= " order by id desc";

	$sql = "select * from $where $limit";
	$d->query($sql);
	$items = $d->result_array();

	$url = "index.php?com=order&act=man&id_tinhtrang=".$_REQUEST['id_tinhtrang'];
	$paging = pagination($where,$per_page,$page,$url);		
}

function get_item(){
	global $d, $item,$result_ctdonhang;
	$id = isset($_GET['id']) ? themdau($_GET['id']) : "";
	if(!$id)
		transfer("Không nhận được dữ liệu", "index.php?com=order&act=man&id_tinhtrang=".$_REQUEST['id_tinhtrang']);
	
	$sql = "select * from #_order where id='".$id."'";
	$d->query($sql);
	if($d->num_rows()==0) transfer("Dữ liệu không có thực", "index.php?com=order&act=man&id_tinhtrang=".$_REQUEST['id_tinhtrang']);
	$item = $d->fetch_array();

	$sqlUPDATE_ORDER = "UPDATE table_order SET view =1 WHERE  id = ".$id."";
	$resultUPDATE_ORDER = mysql_query($sqlUPDATE_ORDER) or die("Not query sqlUPDATE_ORDER");
	
	
	$d->reset();
	$sql="select * from #_order_detail where id_order = '".$item['madonhang']."'";
	$d->query($sql);
	$result_ctdonhang=$d->result_array();
}

function save_item(){
	global $d;
	$file_name=fns_Rand_digit(0,9,12);
	if(empty($_POST)) transfer("Không nhận được dữ liệu", "index.php?com=order&act=man&id_tinhtrang=".$_REQUEST['id_tinhtrang']);
	$id = isset($_POST['id']) ? themdau($_POST['id']) : "";
	
	
	if($id){
		$id =  themdau($_POST['id']);			
		
		$data['ghichu'] = $_POST['ghichu'];
		$data['trangthai'] = $_POST['id_tinhtrang'];				
		$d->setTable('order');
		$d->setWhere('id', $id);
		if($d->update($data))
			redirect("index.php?com=order&act=man&id_tinhtrang=".$_REQUEST['id_tinhtrang']."&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=order&act=man&id_tinhtrang=".$_REQUEST['id_tinhtrang']."&curPage=".$_REQUEST['curPage']."");
	}
}

function delete_item(){
	global $d;
	if(isset($_GET['id'])){
		$id =  themdau($_GET['id']);
		$d->reset();
		$sql = "delete from #_order where id = '".$id."'";
		$d->query($sql);
		
		$d->reset();
		$sql = "delete from #_order_detail where id_order = '".$id."'";
		$d->query($sql);
		
		if($d->query($sql))
			redirect("index.php?com=order&act=man&id_tinhtrang=".$_REQUEST['id_tinhtrang']."&curPage=".$_REQUEST['curPage']."");
		else
			transfer("Xóa dữ liệu bị lỗi", "index.php?com=order&act=man&id_tinhtrang=".$_REQUEST['id_tinhtrang']."&curPage=".$_REQUEST['curPage']."");

	} elseif (isset($_GET['listid'])==true){
		$listid = explode(",",$_GET['listid']); 
		for ($i=0 ; $i<count($listid) ; $i++){
			$idTin=$listid[$i]; 
			$id =  themdau($idTin);		
			$d->reset();
			$sql = "delete from #_order where id = '".$id."'";
			$d->query($sql);
			
			$d->reset();
			$sql = "delete from #_order_detail where id_order = '".$id."'";
			$d->query($sql);
		}
		redirect("index.php?com=order&act=man&id_tinhtrang=".$_REQUEST['id_tinhtrang']."&curPage=".$_REQUEST['curPage']."");
	} else {
		transfer("Không nhận được dữ liệu", "index.php?com=order&act=man&id_tinhtrang=".$_REQUEST['id_tinhtrang']."&curPage=".$_REQUEST['curPage']."");
	}
}
?>
<?php
	include_once "ajax_lib.php";
	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false)){
		header('Content-Type: text/html; charset=utf-8');
		die("Bạn Không có quyền vào đây !");
	}else{
		$id=$_POST['id'];
		$table=$_POST['table'];
		$d->reset();
		$sql = "select id,photo,thumb from #_$table where id='".$id."'";
		$d->query($sql);
		$row = $d->result_array();

		if(count($row)>0){
			for($i=0;$i<count($row);$i++){
				if($table=='product_photo'){
					delete_file('../'._upload_product.$row[$i]['photo']);
					delete_file('../'._upload_product.$row[$i]['thumb']);
				}
				if($table=='album'){
					delete_file('../'._upload_album.$row[$i]['photo']);
					delete_file('../'._upload_album.$row[$i]['thumb']);
				}
				if($table=='baiviet_photo'){
					delete_file('../'._upload_baiviet.$row[$i]['photo']);
					delete_file('../'._upload_baiviet.$row[$i]['thumb']);
				}
				
			}
			$sql = "delete from #_$table where id='".$id."'";
			$d->query($sql);
		}
	}

	
	
?>

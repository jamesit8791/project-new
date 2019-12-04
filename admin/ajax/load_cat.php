<?php
	include_once "ajax_lib.php";
	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false)){
		header('Content-Type: text/html; charset=utf-8');
		die("Bạn Không có quyền vào đây !");
	}else{
		$id_list=(int)$_POST['id_list'];
		$id_cat=(int)$_POST['id_cat'];

		if(!is_array($id_list)){
			$id_list = json_decode($id_list);
		}

		if(!is_array($id_cat)){
			$id_cat = json_decode($id_cat);
		}

		$where .= " hienthi=1 ";
		if(count($id_list)>0){
			if(in_array('all',$id_list)){
				
			} else {
				$where .= "  and ( id_list=".$id_list[0];
				for($i=1;$i<count($id_list);$i++){
					$where .= " or id_list=".$id_list[$i];
				}
				$where .= " ) ";
			}
		}

		$d->reset();
	    $sql = "select id,ten_vi from #_product_cat where $where order by id desc";
	    $d->query($sql);
	    $row_cat = $d->result_array();
	    $str = '';
		for($i=0;$i<count($row_cat);$i++){   

			if($id_cat!=''){
				if(in_array($row_cat[$i]['id'],$id_cat)){  
					$select = 'selected="selected"';
				} 
			}

			$str .= '<option value="'.$row_cat[$i]['id'].'" '.$select.'>'.$row_cat[$i]['ten_vi'].'</option>';
		}  

		echo $str;
	}
?>
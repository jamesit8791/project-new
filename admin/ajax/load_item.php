<?php 
	include_once "ajax_lib.php";
	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false)){
		header('Content-Type: text/html; charset=utf-8');
		die("Bạn Không có quyền vào đây !");
	}else{
		$id_cat=(int)$_POST['id_cat'];
		$id_item=(int)$_POST['id_item'];

		if(!is_array($id_item)){
			$id_item = json_decode($id_item);
		}

		if(!is_array($id_item)){
			$id_item = json_decode($id_item);
		}

		$where .= " hienthi=1 ";
		if(count($id_item)>0){
			if(in_array('all',$id_item)){
				
			} else {
				$where .= "  and ( id_item=".$id_item[0];
				for($i=1;$i<count($id_item);$i++){
					$where .= " or id_item=".$id_item[$i];
				}
				$where .= " ) ";
			}
		}

		$d->reset();
	    $sql = "select id,ten_vi from #_product_item where $where order by id desc";
	    $d->query($sql);
	    $row_item = $d->result_array();
	    $str = '';
		for($i=0;$i<count($row_item);$i++){   

			if($id_item!=''){
				if(in_array($row_item[$i]['id'],$id_item)){  
					$select = 'selected="selected"';
				} 
			}

			$str .= '<option value="'.$row_item[$i]['id'].'" '.$select.'>'.$row_item[$i]['ten_vi'].'</option>';
		}  

		echo $str;
	}

?>
<?php  if(!defined('_source')) die("Error");

		@$idc = addslashes($_GET['idc']);

		$per_page = $row_setting['page_sp'];
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;


		if($com=='tag'){
			if(isset($_GET['idl']) && $_GET['idl'] !=''){
				$tukhoa = trim($_GET['idl']);
				if (get_magic_quotes_gpc()==false) {
					$tukhoa = mysql_real_escape_string($tukhoa);
				}

				$chuoi = " and (tagskhongdau like'%$tukhoa%')";
			}
		}else{
			if(isset($_GET['keyword']) && $_GET['keyword'] !=''){
				$tukhoa = trim(strip_tags($_GET['keyword']));
				if (get_magic_quotes_gpc()==false) {
					$tukhoa = changeSearch(mysql_real_escape_string($tukhoa));
				}

				$chuoi = " and text_search like'%$tukhoa%'";
			}

			if(isset($_GET['id_list']) && $_GET['id_list'] !='' && $_GET['id_list'] !=0){
				$id_list = trim(strip_tags($_GET['id_list']));
				if (get_magic_quotes_gpc()==false) {
					$id_list = mysql_real_escape_string($id_list);
				}

				$chuoi = " and id_list = $id_list";
			}
		}
		$where = " #_product where hienthi>0 ".$chuoi." and type in ('san-pham') order by stt,id desc";

		$sql = "select * from $where $limit";

		$d->query($sql);
		$product = $d->result_array();
		$url = getCurrentPageURL();
		$paging = pagination($where,$per_page,$page,$url);

		$product_count = get_result_array("select * from $where");

		$title = _found." ".count($product_count)." "._result;

		$breadcumb ='<ul id="breadcrumb">
                <li><a href="">'._home.'</a></li>
                <li><a>'.$title.'</a></li>
              </ul>';
?>

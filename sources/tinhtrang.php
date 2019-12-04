<?php  if(!defined('_source')) die("Error");
	
	$breadcumb ='<ul id="breadcrumb">
                <li><a href="">'._home.'</a></li>
                <li><a href="san-pham.html">'._product.'</a></li>
                <li><a href="'.$com.'.html">'.$bread.'</a></li>
              </ul>';

	$per_page = $row_setting['page_sp'];
	$startpoint = ($page * $per_page) - $per_page;
	$limit = ' limit '.$startpoint.','.$per_page;

	$where = " #_product where hienthi=1 and type='".$type_com."' and $kieu=1 ";
	$where .= $where_tk;
	$where .= " order by stt,ngaytao desc ";

	$sql = "select * from $where $limit";
	$d->query($sql);
	$product = $d->result_array();

	$url = getCurrentPageURL();
	$paging = pagination($where,$per_page,$page,$url);

	if(count($product)==0) $title_cat= _updating;
?>
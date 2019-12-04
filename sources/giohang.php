<?php  if(!defined('_source')) die("Error");

		
	$d->reset();
	$sql = "select title,keywords,description from #_setting";
	$d->query($sql);
	$row_detail = $d->fetch_array();
	$title = 'Giỏ hàng';
	$title_bar .= $row_detail['title'];
	$keyword_bar .= $row_detail['keywords'];
	$description_bar .= $row_detail['description'];
	$breadcumb ='<ul id="breadcrumb">
                <li><a href="">'._home.'</a></li>
                <li><a href="'.$com.'.html">'.$title.'</a></li>
              </ul>';

?>
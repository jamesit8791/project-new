<?php  if(!defined('_source')) die("Error");
	
	$d->reset();
	$sql = "select ten_$lang,noidung_$lang,title,keywords,description from #_info where type='$type_com' ";
	$d->query($sql);
	$row_detail = $d->fetch_array();

	$breadcumb ='<ul id="breadcrumb">
                <li><a href="">'._home.'</a></li>
                <li><a href="'.$com.'">'.$title.'</a></li>
              </ul>';

	$d->reset();
	$sql = "select title,keywords,description from #_seo where type='".$com."'";
	$d->query($sql);
	$row_seo = $d->fetch_array();

	$title_bar = $row_seo['title'];
	$keyword_bar = $row_seo['keywords'];
	$description_bar = $row_seo['description'];

	if($row_detail["noidung_$lang"]=="") $title_cat="Nội Dung Đang Cập Nhật...";
?>
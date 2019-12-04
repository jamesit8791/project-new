<?php  if(!defined('_source')) die("Error");
	@$id =  addslashes($_GET['id']);
	@$id_list =  addslashes($_GET['idl']);

	if($id!=''){
		$row_detail = get_fetch_array("select * from #_album where id='$id'");
		$title = $row_detail["ten_$lang"];
		$title_cat = $row_detail["ten_$lang"];
		$title_bar .= $row_detail['title'];
		$keyword_bar .= $row_detail['keywords'];
		$description_bar .= $row_detail['description'];
		$tintuc = get_result_array("select * from #_album_photo where id_album='".$row_detail['id']."' and type='".$type_com."' and hienthi>0 order by stt,id desc");
		$breadcumb = '<ul id="breadcrumb">
                <li><a href=""><span class="fa fa-home"> </span></a></li>
                <li><a href="">'._home.'</a></li>
                <li><a href="'.$com.'/'.$row_detail['tenkhongdau'].'.html">'.$title.'</a></li>
              </ul>';
		if($row_detail["noidung_$lang"]=="") $title_cat="Nội Dung Đang Cập Nhật...";

	}elseif($id_list!=''){

		$row_detail = get_fetch_array("select ten_$lang,title,keywords,description,id from #_album_list where type='".$type_com."' and hienthi=1 and tenkhongdau='$id_list'");

		$per_page = 20; // Set how many records do you want to display per page.
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;
		
		$where = " #_album where hienthi=1 and type='".$type_com."' and id_list='".$row_detail['id']."'  order by stt,ngaytao desc";

		$d->reset();
		$sql="select id,photo,ten_$lang,tenkhongdau,mota_$lang,thumb from $where $limit";
		$d->query($sql);
		$tintuc=$d->result_array();


		$url = getCurrentPageURL();
		$paging = pagination($where,$per_page,$page,$url);

		$title_cat = $row_detail["ten_$lang"];
		$title = $row_detail["ten_$lang"];
		$title_bar .= $row_detail['title'];
		$keyword_bar .= $row_detail['keywords'];
		$description_bar .= $row_detail['description'];

		$breadcumb ='<ul id="breadcrumb">
                <li><a href=""><span class="fa fa-home"> </span></a></li>
                <li><a href="">'._home.'</a></li>
                <li><a href="'.$com.'/'.$row_detail['tenkhongdau'].'">'.$title.'</a></li>
              </ul>';

	}else{

		$per_page = 12; // Set how many records do you want to display per page.
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;

		$where = " #_album where type='".$type_com."' and hienthi>0 order by stt,id desc";

		$d->reset();
		$sql="select id,photo,ten_$lang,tenkhongdau,thumb from $where $limit";
		$d->query($sql);
		$tintuc=$d->result_array();

		$url = getCurrentPageURL();
		$paging = pagination($where,$per_page,$page,$url);

		$title_bar .= $title_cat;
		
		if(count($tintuc)==0) $title_cat="Nội Dung Đang Cập Nhật...";

		$breadcumb ='<ul id="breadcrumb">
                <li><a href=""><span class="fa fa-home"> </span></a></li>
                <li><a href="">'._home.'</a></li>
                <li><a href="'.$com.'.html">'.$title.'</a></li>
              </ul>';

	}

	
?>
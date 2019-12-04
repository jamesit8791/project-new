<?php  if(!defined('_source')) die("Error");
	
	@$id =  addslashes($_GET['id']);
	@$id_list =  addslashes($_GET['idl']);
	@$id_cat =  addslashes($_GET['idc']);
	@$id_item =  addslashes($_GET['idi']);

	if($id!=''){
		$sql_update = "update #_baiviet SET luotxem=luotxem+1 where id='".$id."'";
		$d->query($sql_update);
		
		$row_detail = get_fetch_array("select * from #_baiviet where hienthi=1 and type='".$type_com."' and id='".$id."'");

		if(empty($row_detail)){
			$template = '404';
			header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
		}
		$title_cat = $row_detail["ten_$lang"];
		$title_bar .= $row_detail['title'];
		$keyword_bar .= $row_detail['keywords'];
		$description_bar .= $row_detail['description'];
		$title = $row_detail["ten_$lang"];
		
		$share_facebook = '<meta property="og:url" content="'.getCurrentPageURL().'" />
<meta property="og:type" content="website" />
<meta property="og:title" content="'.$row_detail['ten_'.$lang].'" />
<meta property="og:description" content="'.strip_tags($row_detail['description']).'" />
<meta property="og:locale" content="vi" />
<meta property="og:image" content="http://'.$config_url.'/'._upload_baiviet_l.$row_detail['photo'].'" />
<meta itemprop="name" content="'.$row_detail['title'].'">
<meta itemprop="description" content="'.strip_tags($row_detail['description']).'">
<meta itemprop="image" content="http://'.$config_url.'/'._upload_baiviet_l.$row_detail['photo'].'">
<meta name="twitter:card" content="product">
<meta name="twitter:site" content="'.$row_detail['ten_'.$lang].'">
<meta name="twitter:title" content="'.$row_detail['title'].'">
<meta name="twitter:description" content="'.strip_tags($row_detail['description']).'">
<meta name="twitter:creator" content="'.$row_detail['title'].'">
<meta name="twitter:image" content="http://'.$config_url.'/'._upload_baiviet_l.$row_detail['photo'].'">
<script type="application/ld+json">
{
	"@context": "http://schema.org/",
	"@type": "Article",
	"name": "'.$row_setting['ten_'.$lang].'",
	"author": "'.$row_setting['ten_'.$lang].'",
	"image": "http://'.$config_url.'/'._upload_baiviet_l.$row_detail['photo'].'",
	"description": "'.strip_tags($row_detail['description']).'",
	"aggregateRating": {
		"@type": "Article",
		"ratingValue": "4.5",
		"reviewCount": "'.$row_detail['luotxem'].'",
		"bestRating": "5",
		"worstRating": "1"
	}
}
</script>
';

		if($row_detail['id_list']!=0 && $row_detail['id_cat']==0 && $row_detail['id_item']==0){
			
			$list_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_baiviet_list where hienthi=1 and type='".$type_com."' and id='".$row_detail['id_list']."'");

			$breadcumb ='<ul id="breadcrumb">
            <li><a href="">'._home.'</a></li>
            <li><a href="'.$com.'">'.$bread.'</a></li>
            <li><a href="'.$list_detail['tenkhongdau'].'">'.$list_detail['ten_'.$lang].'</a></li>
            <li><a href="'.$row_detail['tenkhongdau'].'">'.$row_detail['ten_'.$lang].'</a></li>
          </ul>';

		}elseif($row_detail['id_list']!=0 && $row_detail['id_cat']!=0 && $row_detail['id_item']==0){
			
			$list_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_baiviet_list where hienthi=1 and type='".$type_com."' and id='".$row_detail['id_list']."'");
			$cat_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_baiviet_cat where hienthi=1 and type='".$type_com."' and id='".$row_detail['id_cat']."'");

			$breadcumb ='<ul id="breadcrumb">
            <li><a href="">'._home.'</a></li>
            <li><a href="'.$com.'">'.$bread.'</a></li>
            <li><a href="'.$list_detail['tenkhongdau'].'">'.$list_detail['ten_'.$lang].'</a></li>
            <li><a href="'.$cat_detail['tenkhongdau'].'">'.$cat_detail['ten_'.$lang].'</a></li>
            <li><a href="'.$row_detail['tenkhongdau'].'">'.$row_detail['ten_'.$lang].'</a></li>
          </ul>';
		
		}elseif($row_detail['id_list']!=0 && $row_detail['id_cat']!=0 && $row_detail['id_item']!=0){
			
			$list_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_baiviet_list where hienthi=1 and type='".$type_com."' and id='".$row_detail['id_list']."'");
			$cat_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_baiviet_cat where hienthi=1 and type='".$type_com."' and id='".$row_detail['id_cat']."'");
			$item_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_baiviet_cat where hienthi=1 and type='".$type_com."' and id='".$row_detail['id_list']."'");

			$breadcumb ='<ul id="breadcrumb">
            <li><a href="">'._home.'</a></li>
            <li><a href="'.$com.'">'.$bread.'</a></li>
            <li><a href="'.$list_detail['tenkhongdau'].'">'.$list_detail['ten_'.$lang].'</a></li>
            <li><a href="'.$cat_detail['tenkhongdau'].'">'.$cat_detail['ten_'.$lang].'</a></li>
            <li><a href="'.$item_detail['tenkhongdau'].'">'.$item_detail['ten_'.$lang].'</a></li>
            <li><a href="'.$row_detail['tenkhongdau'].'">'.$row_detail['ten_'.$lang].'</a></li>
          </ul>';
		
		}else{
			$breadcumb ='<ul id="breadcrumb">
            <li><a href="">'._home.'</a></li>
            <li><a href="'.$com.'">'.$bread.'</a></li>
            <li><a href="'.$row_detail['tenkhongdau'].'">'.$row_detail['ten_'.$lang].'</a></li>
          </ul>';
		}
		$tintuc_khac = get_result_array("select * from #_baiviet where hienthi=1 and type='".$row_detail['type']."' and id<>'".$id."' limit 0,6");
		$row_prev = get_fetch_array("select id,ten_$lang as ten, tenkhongdau from #_baiviet where hienthi=1 and type='".$type_com."' and id<'".$row_detail['id']."' order by id desc limit 0,1");
		$row_next = get_fetch_array("select id,ten_$lang as ten, tenkhongdau from #_baiviet where hienthi=1 and type='".$type_com."' and id>'".$row_detail['id']."' order by id desc limit 0,1");

		if($row_detail["noidung_$lang"]=="") $title_cat="Nội Dung Đang Cập Nhật...";
	}else if($id_list!='' && $id_cat=='' && $id_item==''){

			$row_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_baiviet_list where hienthi=1 and type='$type_com' and id='".$id_list."'");
			if(empty($row_detail)){
				$template = '404';
				header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
			}
			$per_page = $row_setting['page_ne']; // Set how many records do you want to display per page.
			$startpoint = ($page * $per_page) - $per_page;
			$limit = ' limit '.$startpoint.','.$per_page;
			
			$where = " #_baiviet where hienthi=1 and type='$type_com' and id_list='".$row_detail['id']."'  order by stt,ngaytao desc";

			$d->reset();
			$sql="select id,photo,ten_$lang,tenkhongdau,mota_$lang,thumb,ngaytao,diachi,link_maps,link_facebook,iframe_maps from $where $limit";
			$d->query($sql);
			$tintuc=$d->result_array();
		
			$url = getCurrentPageURL();
			$paging = pagination($where,$per_page,$page,$url);

			$title = $row_detail["ten_$lang"];
			$title_cat = $row_detail["ten_$lang"];
			$title = $row_detail["ten_$lang"];
			$title_bar .= $row_detail['title'];
			$keyword_bar .= $row_detail['keywords'];
			$description_bar .= $row_detail['description'];

			$breadcumb ='<ul id="breadcrumb">
                <li><a href="">'._home.'</a></li>
                <li><a href="'.$com.'">'.$bread.'</a></li>
                <li><a href="'.$row_detail['tenkhongdau'].'">'.$row_detail['ten_'.$lang].'</a></li>
              </ul>';

		}elseif($id_list!='' && $id_cat!='' && $id_item==''){

			$row_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_baiviet_cat where hienthi=1 and type='$type_com' and id='".$id_cat."'");
			if(empty($row_detail)){
				$template = '404';
				header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
			}
			$per_page = $row_setting['page_ne'];
			$startpoint = ($page * $per_page) - $per_page;
			$limit = ' limit '.$startpoint.','.$per_page;
			
			$where = " #_baiviet where hienthi=1 and type='$type_com' and id_cat='".$row_detail['id']."'  order by stt,ngaytao desc";

			$d->reset();
			$sql="select id,photo,ten_$lang,tenkhongdau,mota_$lang,thumb,ngaytao,diachi,link_maps,link_facebook,iframe_maps from $where $limit";
			$d->query($sql);
			$tintuc=$d->result_array();
			
			$url = getCurrentPageURL();
			$paging = pagination($where,$per_page,$page,$url);

			$title = $row_detail["ten_$lang"];
			$title_cat = $row_detail["ten_$lang"];
			$title = $row_detail["ten_$lang"];
			$title_bar .= $row_detail['title'];
			$keyword_bar .= $row_detail['keywords'];
			$description_bar .= $row_detail['description'];

			$list_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_baiviet_list where hienthi=1 and type='".$type_com."' and id='".$row_detail['id_list']."'");

			$breadcumb ='<ul id="breadcrumb">
                <li><a href="">'._home.'</a></li>
                <li><a href="'.$com.'">'.$bread.'</a></li>
                <li><a href="'.$list_detail['tenkhongdau'].'">'.$list_detail['ten_'.$lang].'</a></li>
                <li><a href="'.$row_detail['tenkhongdau'].'">'.$row_detail['ten_'.$lang].'</a></li>
              </ul>';

		}elseif($id_list!='' && $id_cat!='' && $id_item!=''){

			$row_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_baiviet_item where hienthi=1 and type='$type_com' and id='".$id_cat."'");
			if(empty($row_detail)){
				$template = '404';
				header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
			}
			$per_page = $row_setting['page_ne']; // Set how many records do you want to display per page.
			$startpoint = ($page * $per_page) - $per_page;
			$limit = ' limit '.$startpoint.','.$per_page;
			
			$where = " #_baiviet where hienthi=1 and type='$type_com' and id_item='".$row_detail['id']."'  order by stt,ngaytao desc";

			$d->reset();
			$sql="select id,photo,ten_$lang,tenkhongdau,mota_$lang,thumb,ngaytao,diachi,link_maps,link_facebook,iframe_maps from $where $limit";
			$d->query($sql);
			$tintuc=$d->result_array();
			
			$url = getCurrentPageURL();
			$paging = pagination($where,$per_page,$page,$url);

			$title = $row_detail["ten_$lang"];
			$title_cat = $row_detail["ten_$lang"];
			$title = $row_detail["ten_$lang"];
			$title_bar .= $row_detail['title'];
			$keyword_bar .= $row_detail['keywords'];
			$description_bar .= $row_detail['description'];

			$list_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_baiviet_list where hienthi=1 and type='".$type_com."' and id='".$row_detail['id_list']."'");
			$cat_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_baiviet_cat where hienthi=1 and type='".$type_com."' and id='".$row_detail['id_cat']."'");

			$breadcumb ='<ul id="breadcrumb">
                <li><a href="">'._home.'</a></li>
                <li><a href="'.$com.'">'.$bread.'</a></li>
                <li><a href="'.$list_detail['tenkhongdau'].'">'.$list_detail['ten_'.$lang].'</a></li>
                <li><a href="'.$cat_detail['tenkhongdau'].'">'.$cat_detail['ten_'.$lang].'</a></li>
                <li><a href="'.$row_detail['tenkhongdau'].'">'.$row_detail['ten_'.$lang].'</a></li>
              </ul>';

		}else{
		

		$per_page = $row_setting['page_ne']; // Set how many records do you want to display per page.
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;

		$where = " #_baiviet where type='$type_com' and hienthi>0 order by stt,id desc";

		$d->reset();
		$sql="select id,photo,ten_$lang,tenkhongdau,mota_$lang,thumb,ngaytao,diachi,link_maps,link_facebook,iframe_maps from $where $limit";
		$d->query($sql);
		$tintuc=$d->result_array();

		$breadcumb ='<ul id="breadcrumb">
                <li><a href="">'._home.'</a></li>
                <li><a href="'.$com.'">'.$title.'</a></li>
              </ul>';
		$url = getCurrentPageURL();
		$paging = pagination($where,$per_page,$page,$url);
		
		$d->reset();
		$sql = "select title,keywords,description from #_seo where type='".$com."'";
		$d->query($sql);
		$row_seo = $d->fetch_array();

		$title_bar = $row_seo['title'];
		$keyword_bar = $row_seo['keywords'];
		$description_bar = $row_seo['description'];
		
		$title_bar .= $title_cat;
		if(count($tintuc)==0) $title_cat="Nội Dung Đang Cập Nhật...";
	}

?>
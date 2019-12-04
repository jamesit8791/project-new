<?php  if(!defined('_source')) die("Error");
	@$id =  addslashes($_GET['id']);
	@$idl =  addslashes($_GET['idl']);

	if($idl!=''){

		$row_list = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description,photo,quangcao,mota_$lang from #_product_list where hienthi=1 and type='".$type_com."' and id='".$idl."'");
		// print_r($row_list);
		if($row_list){
			if($psize!=0){
				$per_page = $psize; // Set how many records do you want to display per page.
			}else{
				$per_page = $row_setting['page_sp'];
			}

			$startpoint = ($page * $per_page) - $per_page;
			$limit = ' limit '.$startpoint.','.$per_page;

			$where = " #_product where hienthi=1 and type='".$type_com."' and id_list='".$row_list['id']."'  order by stt,ngaytao desc";

			$sql = "select * from $where $limit";
			$d->query($sql);
			$product = $d->result_array();

			$url = getCurrentPageURL();
			$paging = pagination($where,$per_page,$page,$url);

			$breadcumb ='<ul id="breadcrumb">
	            <li><a href="">'._home.'</a></li>
				<li><a href="'.$com.'">'.$bread.'</a></li>
	            <li><a href="'.$row_list['tenkhongdau'].'">'.$row_list['ten_'.$lang].'</a></li>
	          </ul>';
			$title_cat = $row_list["ten_$lang"];
			$title = $row_list["ten_$lang"];
			$title_bar .= $row_list['title'];
			$keyword_bar .= $row_list['keywords'];
			$description_bar .= $row_list['description'];

			if(count($product)==0) $title_cat= _updating;

			if($row_list['quangcao']){
				$iconimg = _upload_product_l.$row_list['quangcao'];
			}

			$result_cat = get_result_array("select id,ten_$lang,tenkhongdau,title,keywords,description,id_list,photo from #_product_cat where hienthi=1 and type='".$type_com."' and id_list='".$row_list['id']."' order by stt asc, id desc");
		}

		$row_cat = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description,id_list from #_product_cat where hienthi=1 and type='".$type_com."' and id='".$idl."'");

		if($row_cat){
			if($psize!=0){
				$per_page = $psize; // Set how many records do you want to display per page.
			}else{
				$per_page = $row_setting['page_sp'];
			}


			$startpoint = ($page * $per_page) - $per_page;
			$limit = ' limit '.$startpoint.','.$per_page;

			$where = " #_product where hienthi=1 and type='".$type_com."' and id_cat='".$row_cat['id']."'  order by stt,ngaytao desc";

			$sql = "select * from $where $limit";
			$d->query($sql);
			$product = $d->result_array();

			$url = getCurrentPageURL();
			$paging = pagination($where,$per_page,$page,$url);

			$list_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description,photo,quangcao from #_product_list where hienthi=1 and type='".$type_com."' and id='".$row_cat['id_list']."'");

			$breadcumb ='<ul id="breadcrumb">
                <li><a href="">'._home.'</a></li>
                <li><a href="'.$com.'">'.$bread.'</a></li>
                <li><a href="'.$list_detail['tenkhongdau'].'">'.$list_detail['ten_'.$lang].'</a></li>
                <li><a href="'.$row_cat['tenkhongdau'].'">'.$row_cat['ten_'.$lang].'</a></li>
              </ul>';

			$title_cat = $row_cat['ten_'.$lang];
			$title = $row_cat['ten_'.$lang];
			$title_bar .= $row_cat['title'];
			$keyword_bar .= $row_cat['keywords'];
			$description_bar .= $row_cat['description'];

			if($list_detail['quangcao']){
				$iconimg = _upload_product_l.$list_detail['quangcao'];
			}


			if(count($product)==0) $title_cat= _updating;
		}

		$row_item = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_product_item where hienthi=1 and type='".$type_com."' and id='".$idl."'");

		if($row_item){
			if($psize!=0){
				$per_page = $psize; // Set how many records do you want to display per page.
			}else{
				$per_page = $row_setting['page_sp'];
			}


			$startpoint = ($page * $per_page) - $per_page;
			$limit = ' limit '.$startpoint.','.$per_page;

			$where = " #_product where hienthi=1 and type='".$type_com."' and id_item='".$row_item['id']."'  order by stt,ngaytao desc";

			$sql = "select * from $where $limit";
			$d->query($sql);
			$product = $d->result_array();

			$url = getCurrentPageURL();
			$paging = pagination($where,$per_page,$page,$url);

			$list_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description,photo from #_product_list where hienthi=1 and type='".$type_com."' and id='".$row_item['id_list']."'");

			$cat_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_product_cat where hienthi=1 and type='".$type_com."' and id='".$row_item['id_cat']."'");
			if($list_detail['photo']){
				$iconimg = '<span><img src="'._upload_product_l.$list_detail['photo'].'" alt="'.$title.'"></span>';
			}

			$breadcumb ='<ul id="breadcrumb">
                <li><a href="">'._home.'</a></li>
                <li><a href="'.$com.'">'.$bread.'</a></li>
                <li><a href="'.$list_detail['tenkhongdau'].'">'.$list_detail['ten_'.$lang].'</a></li>
                <li><a href="'.$cat_detail['tenkhongdau'].'">'.$cat_detail['ten_'.$lang].'</a></li>
                <li><a href="'.$row_item['tenkhongdau'].'">'.$row_item['ten_'.$lang].'</a><li>
              </ul>';

			$title_cat = $row_item['ten_'.$lang];
			$title = $row_item['ten_'.$lang];
			$title_bar .= $row_item['title'];
			$keyword_bar .= $row_item['keywords'];
			$description_bar .= $row_item['description'];

			if(count($product)==0) $title_cat= _updating;
		}

		if(empty($row_list) && empty($row_cat) && empty($row_item)){
			$template = '404';
			header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
		}
	}

	if($id!=''){
		$row_detail = get_fetch_array("select * from #_product where hienthi=1 and type='".$type_com."' and id='".$id."'");

		if(empty($row_detail)){
			$template = '404';
			header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
		}else{
			$luotxem = $row_detail['luotxem']+1;
			$sql_update = "update #_product SET luotxem=$luotxem where id=".$row_detail['id'];
			$d->query($sql_update);
		}

		

			if($row_detail['description']!='') $ke = $row_detail['description']; else $ke = $row_setting['keywords']; 
			$share_facebook = '<meta property="og:url" content="'.getCurrentPageURL().'" />
<meta property="og:type" content="website" />
<meta property="og:title" content="'.$row_detail['ten_'.$lang].'" />
<meta property="og:description" content="'.strip_tags($row_detail['description']).'" />
<meta property="og:locale" content="vi" />
<meta property="og:image" content="http://'.$config_url.'/'._upload_product_l.$row_detail['photo'].'" />
<meta itemprop="name" content="'.$row_detail['title'].'">
<meta itemprop="description" content="'.strip_tags($row_detail['description']).'">
<meta itemprop="image" content="http://'.$config_url.'/'._upload_product_l.$row_detail['photo'].'">
<meta name="twitter:card" content="product">
<meta name="twitter:site" content="'.$row_detail['ten_'.$lang].'">
<meta name="twitter:title" content="'.$row_detail['title'].'">
<meta name="twitter:description" content="'.strip_tags($row_detail['description']).'">
<meta name="twitter:creator" content="'.$row_detail['title'].'">
<meta name="twitter:image" content="http://'.$config_url.'/'._upload_product_l.$row_detail['photo'].'">
<script type="application/ld+json">
{
	"@context": "http://schema.org/",
	"@type": "Product",
	"name": "'.$row_setting['ten_'.$lang].'",
	"image": "http://'.$config_url.'/'._upload_product_l.$row_detail['photo'].'",
	"description": "'.$ke.'",
	"aggregateRating": {
		"@type": "AggregateRating",
		"ratingValue": "'.rand(1,5).'",
		"reviewCount": "'.$row_detail['luotxem'].'"
	},
	"sku": "'.rand(50000,1280000).'",
	"mpn": "'.rand(20000,50000).'",
	"brand": {
		"@type": "Thing",
		"name": "'.$row_setting['ten_'.$lang].'"
	},
	"review": {
	    "@type": "Review",
	    "reviewRating": {
	      "@type": "Rating",
	      "ratingValue": "4",
	      "bestRating": "5"
	    },
	    "author": {
	      "@type": "Person",
	      "name": "James Nguyen"
	    }
	},
	"offers": {
	    "@type": "Offer",
	    "url": "'.getCurrentPageURL().'",
	    "priceCurrency": "VND",
	    "price": "'.number_format($row_detail['giaban'],0, ',', '.').'",
	    "priceValidUntil": "'.date('Y-m-d',$row_detail['ngaytao']).'",
	    "itemCondition": "https://schema.org/UsedCondition",
	    "availability": "https://schema.org/InStock",
	    "seller": {
	      "@type": "Organization",
	      "name": "'.$row_setting['ten_'.$lang].'"
	    }
  	}
}
</script>';

			if($row_detail['id_list']!=0 && $row_detail['id_cat']==0){

				$list_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_product_list where hienthi=1 and type='".$type_com."' and id='".$row_detail['id_list']."'");

				$breadcumb ='<ul id="breadcrumb">
                <li><a href="">'._home.'</a></li>
                <li><a href="'.$com.'">'.$bread.'</a></li>
                <li><a href="'.$list_detail['tenkhongdau'].'">'.$list_detail['ten_'.$lang].'</a></li>
                <li><a href="'.$row_detail['tenkhongdau'].'">'.$row_detail['ten_'.$lang].'</a></li>
              </ul>';


			}elseif($row_detail['id_list']!=0 && $row_detail['id_cat']!=0 && $row_detail['id_item']==0){

				$list_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_product_list where hienthi=1 and type='".$type_com."' and id='".$row_detail['id_list']."'");
				$cat_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_product_cat where hienthi=1 and type='".$type_com."' and id='".$row_detail['id_cat']."'");

				$breadcumb ='<ul id="breadcrumb">
                <li><a href="">'._home.'</a></li>
                <li><a href="'.$com.'">'.$bread.'</a></li>
                <li><a href="'.$list_detail['tenkhongdau'].'">'.$list_detail['ten_'.$lang].'</a></li>
                <li><a href="'.$cat_detail['tenkhongdau'].'">'.$cat_detail['ten_'.$lang].'</a></li>
                <li><a href="'.$row_detail['tenkhongdau'].'">'.$row_detail['ten_'.$lang].'</a></li>
              </ul>';

			}elseif($row_detail['id_list']!=0 && $row_detail['id_cat']!=0 && $row_detail['id_item']!=0){

				$list_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_product_list where hienthi=1 and type='".$type_com."' and id='".$row_detail['id_list']."'");
				$cat_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_product_cat where hienthi=1 and type='".$type_com."' and id='".$row_detail['id_cat']."'");
				$item_detail = get_fetch_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_product_cat where hienthi=1 and type='".$type_com."' and id='".$row_detail['id_list']."'");

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

			$hinhanh_sp = get_result_array("select * from #_product_photo where hienthi=1 and id_product='".$row_detail['id']."' and type='".$type_com."' order by stt,id desc");

			if($psize!=0){
				$per_page = $psize; // Set how many records do you want to display per page.
			}else{
				$per_page = $row_setting['page_sp'];
			}

			$startpoint = ($page * $per_page) - $per_page;
			$limit = ' limit '.$startpoint.','.$per_page;

			$where = " #_product where hienthi=1 and type='".$type_com."' and id_list='".$row_detail['id_list']."' and id!='".$row_detail['id']."'  order by stt,ngaytao desc";

			$sql = "select * from $where $limit";
			$d->query($sql);
			$product = $d->result_array();

			$url = getCurrentPageURL();
			$paging = pagination($where,$per_page,$page,$url);


			$danhmuc_detail = get_result_array("select id,ten_$lang,tenkhongdau,title,keywords,description from #_product_list where hienthi=1 and type='".$type_com."' order by stt asc, id desc");

			$title = $row_detail['ten_'.$lang];
			$title_bar .= $row_detail['title'];
			$keyword_bar .= $row_detail['keywords'];
			$description_bar .= $row_detail['description'];
	}

	if(!$idl && !$id){
		if($psize!=0){
			$per_page = $psize;
		}else{
			$per_page = $row_setting['page_sp'];
		}
		$startpoint = ($page * $per_page) - $per_page;
		$limit = ' limit '.$startpoint.','.$per_page;

		$where = " #_product where hienthi=1 and type='".$type_com."' ";
		$where .= $where_tk;
		$where .= " order by stt,ngaytao desc ";

		$title_bread = '<a href="" title="Trang chủ">Trang chủ</a> &gt; '._product;

		$breadcumb ='<ul id="breadcrumb">
            <li><a href="">'._home.'</a></li>
            <li><a href="'.$com.'">'.$bread.'</a></li>
          </ul>';

		$sql = "select * from $where $limit";
		$d->query($sql);
		$product = $d->result_array();

		$url = getCurrentPageURL();
		$paging = pagination($where,$per_page,$page,$url);

		$d->reset();
		$sql = "select title,keywords,description from #_seo where type='".$com."'";
		$d->query($sql);
		$row_seo = $d->fetch_array();

		$title_bar = $row_seo['title'];
		$keyword_bar = $row_seo['keywords'];
		$description_bar = $row_seo['description'];
		
		if(count($product)==0) $title_cat= _updating;
	}
?>

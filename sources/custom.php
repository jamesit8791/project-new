<?php
	$logo_top = get_fetch_array("select photo_$lang as photo from #_photo where com='logo'");
	$banner_top = get_fetch_array("select photo_$lang as photo from #_photo where com='banner_top'");
	$bg_visao = get_fetch_array("select photo_vi as photo, link from #_photo where com='bg_visao'");
	$logo_bottom = get_fetch_array("select photo_vi as photo, link, hienthi from #_photo where com='logo_bottom'");
	$bg_content = get_fetch_array("select photo_vi as photo, link from #_photo where com='bg_content'");
	$quangcaocenter = get_fetch_array("select photo_vi as photo, link from #_photo where com='quangcaocenter'");
	$bg_footer = get_fetch_array("select photo_vi as photo, link from #_photo where com='bg_footer'");
	$bocongthuong = get_fetch_array("select photo_vi as photo, link, hienthi from #_photo where com='bocongthuong'");
	$gioithieu = get_fetch_array("select mota_$lang as mota,photo,ten_$lang as ten,photo,thumb,linkvideo from #_info where type='gioi-thieu'");
	
	$footer = get_fetch_array("select noidung_$lang as noidung from #_company where type='footer'");
	$visao_text = get_fetch_array("select noidung_$lang as noidung from #_company where type='visao'");
	if($source=='index'){
		$sanphamcm_nb = get_result_array("select id,ten_$lang as ten,tenkhongdau,thumb,photo from #_product_cat where hienthi=1 and type='san-pham' and noibat=1 order by stt asc,id desc");
		$sanphamdm_nb = get_result_array("select id,ten_$lang as ten, mota_$lang as mota, name_$lang as name,tenkhongdau,photo from #_product_list where hienthi=1 and type='san-pham' and noibat=1 order by stt asc,id desc");
		
		$tintuc_moi = get_result_array("select id,ten_$lang as ten,tenkhongdau,photo,thumb,mota_$lang as mota,ngaytao from #_baiviet where hienthi=1 and type='tin-tuc' and noibat=1 order by stt asc,id desc");
		$dichvu_moi = get_result_array("select id,ten_$lang as ten,tenkhongdau,photo,thumb,mota_$lang as mota,ngaytao from #_baiviet where hienthi=1 and type='dich-vu' and noibat=1 order by stt asc,id desc");
		
		$video_na = get_result_array("select * from #_video where hienthi=1 and type='video' order by stt asc,id desc");
		$about = get_result_array("select photo_vi as photo, mota_$lang as mota, link,ten_$lang as ten,photo_logo from #_photo where hienthi=1 and com='about' order by stt asc,id desc");
		$album = get_result_array("select ten_$lang as ten,id,tenkhongdau,photo from #_album where hienthi=1 and type='album' and noibat=1 order by stt asc,id desc limit 0,5");
	}
	$visao = get_result_array("select id,ten_$lang as ten,tenkhongdau,thumb,photo,mota_$lang as mota from #_baiviet where hienthi=1 and type='vi-sao' order by stt asc,id desc");
	$chinhsach = get_result_array("select id,ten_$lang as ten,tenkhongdau,type from #_baiviet where hienthi=1 and type='chinh-sach' order by stt asc,id desc");
	$tags = get_result_array("select link,ten_$lang as ten from #_photo where hienthi=1 and com='tags' order by stt asc,id desc");
	$sanphamdm = get_result_array("select id,ten_$lang as ten, mota_$lang as mota, name_$lang as name,tenkhongdau,photo from #_product_list where hienthi=1 and type='san-pham' order by stt asc,id desc");
	
	$mangxahoi = get_result_array("select photo_vi as photo,link,ten_$lang as ten from #_photo where com='mangxahoi' order by stt asc,id desc");
	$partner = get_result_array("select photo_vi as photo, link, ten_$lang as ten from #_photo where com='doitac' order by stt asc,id desc");
	$yahoo = get_result_array("select * from #_yahoo where  hienthi=1  order by stt asc,id desc");
	$quangcao = get_result_array("select photo_vi as photo, mota_$lang, link,ten_$lang,photo_logo from #_photo where hienthi=1 and com='quangcao' order by stt asc,id desc");
	$slider = get_result_array("select photo_vi as photo, mota_$lang as mota, link,ten_$lang as ten from #_photo where hienthi=1 and com='slider' order by stt asc,id desc");
	$mangxahoi_mail = get_result_array("select photo_vi as photo,link,ten_$lang as ten from #_photo where hienthi=1 and com='mangxahoi-mail' order by stt asc,id desc");
	
	
	if($share_facebook==''){
		$seo_top = get_fetch_array("select photo_$lang from #_photo where com='hinhdaidien'");

		$share_facebook = '<meta property="og:url" content="'.getCurrentPageURL().'" />
<meta property="og:type" content="website" />
<meta property="og:title" content="'.$row_setting['title'].'" />
<meta property="og:description" content="'.strip_tags($row_setting['description']).'" />
<meta property="og:locale" content="vi" />
<meta property="og:image" content="http://'.$config_url.'/'._upload_hinhanh_l.$seo_top['photo_'.$lang].'" />
<meta itemprop="name" content="'.$row_setting['title'].'">
<meta itemprop="description" content="'.strip_tags($row_setting['description']).'">
<meta itemprop="image" content="http://'.$config_url.'/'._upload_hinhanh_l.$seo_top['photo_'.$lang].'">
<meta name="twitter:card" content="product">
<meta name="twitter:site" content="'.$row_setting['ten_'.$lang].'">
<meta name="twitter:title" content="'.$row_setting['title'].'">
<meta name="twitter:description" content="'.strip_tags($row_setting['description']).'">
<meta name="twitter:creator" content="'.$row_setting['title'].'">
<meta name="twitter:image" content="http://'.$config_url.'/'._upload_hinhanh_l.$seo_top['photo_'.$lang].'">
<script type="application/ld+json">
{
	"@context": "http://schema.org/",
	"@type": "Article",
	"name": "'.$row_setting['ten_'.$lang].'",
	"author": "'.$row_setting['ten_'.$lang].'",
	"image": "http://'.$config_url.'/'._upload_hinhanh_l.$seo_top['photo_'.$lang].'",
	"description": "'.strip_tags($row_setting['description']).'",
	"aggregateRating": {
		"@type": "Article",
		"ratingValue": "4.5",
		"reviewCount": "'.$all_visitors.'",
		"bestRating": "5",
		"worstRating": "1"
	}
}
</script>
';
	}
?>

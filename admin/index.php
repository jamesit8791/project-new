<?php
	session_start();
	@define ( '_template' , './templates/');
	@define ( '_source' , './sources/');
	@define ( '_lib' , '../libraries/');
	
	$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
	if ($page <= 0) $page = 1;
	$lang = 'vi';

	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."functions_giohang.php";
	include_once _lib."library.php";
	include_once _lib."class.database.php";	
	include_once _lib."pclzip.php";
	include_once "simple_html_dom.php";
	$com = (isset($_REQUEST['com'])) ? addslashes($_REQUEST['com']) : "";
	$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";	
	$type_admin = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";
	$login_name = 'NINACO';	

	$d = new database($config['database']);
	
	$archive = new PclZip($file);

	switch($com){
		case 'seo':
			$source = "seo";
			break;
		case 'order':
			$source = "order";
			break;
		case 'dattour':
			$source = "dattour";
			break;
		case 'vnexpress':
			$source = "vnexpress";
			break;
		case 'thanhvien':
			$source = "thanhvien";
			break;
		case 'gia':
			$source = "gia";
			break;
		case 'video':
			$source = "video";
			break;
		case 'post':
			$source = "post";
			break;
		case 'contact':
			$source = "contact";
			break;
		case 'newsletter':
			$source = "newsletter";
			break;
		case 'phanquyen':
			$source = "phanquyen";
			break;
		case 'com':
			$source = "com";
			break;
		case 'donhang':
			$source = "donhang";
			break;
		case 'company':
			$source = "company";
			break;
		case 'baiviet':
			$source = "baiviet";
			break;
		case 'database':
			$source = "database";
			break;
		case 'backup':
			$source = "backup";
			break;		
		case 'info':
			$source = "info";
			break;
		case 'product':
			$source = "product";
			break;
		case 'user':
			$source = "user";
			break;
		case 'lkweb':
			$source = "lkweb";
			break;		
		case 'photo':
			$source = "photo";
			break;														
		case 'setting':
			$source = "setting";
			break;										
		case 'yahoo':
			$source = "yahoo";
			break;
		case 'excel':
			$source = "excel";
			break;										
		case 'bannerqc':
			$source = "bannerqc";
			break;
		case 'album':
			$source = "album";
			break;
		case 'hoidap':
			$source = "hoidap";
			break;
		default: 
			$source = "";
			$template = "index";
			break;
	}

	

	if((!isset($_SESSION[$login_name]) || $_SESSION[$login_name]==false) && $act!="login"){
		redirect("index.php?com=user&act=login");
	}


	if(isset($_SESSION[$login_name]) || $_SESSION[$login_name]==true){
		$id_user = (int)$_SESSION['login']['id'];
		$timenow = time();

		//Thoát tất cả khi đổi user, mật khẩu hoặc quá thời gian 1 tiếng không hoạt động
		$sql="select username,password,lastlogin,user_token from #_user WHERE id ='$id_user'";
		$d->query($sql);
		$row = $d->fetch_array();		
		$cookiehash = md5(sha1($row['password'].$row['username']));
		if( $_SESSION['login_session']!=$cookiehash || ($timenow - $row['lastlogin'])>3600 ) {
			session_destroy();	
			redirect("index.php?com=user&act=login");
		}
		if($_SESSION['login_token']!==$row['user_token']) $notice_admin = '<strong>Có người đang đăng nhập tài khoản của bạn!</strong>';
		else $notice_admin ='';
		$token = md5(time());
		$_SESSION['login_token'] = $token;
		//Cập nhật lại thời gian hoạt động và token		
		$d->reset();
		$sql = "update #_user set lastlogin = '$timenow',user_token = '$token' where id='$id_user'";
		$d->query($sql);
	}


	if($_SESSION['login']['role']==1 && $_GET['com']!='' && $_GET['act']!='logout' && $_GET['act']!='login'){
		if(phanquyen_tv($_GET['com'],$_SESSION['login']['quyen'],$_GET['act'],$_GET['type'])==0){
			$_SESSION['edit']['quyen'] = 'false';
			transfer("Bạn Không có quyền vào đây !","index.php");
		} else {
			$_SESSION['edit']['quyen'] = 'true';
		}
	}

	if($source!="") include _source.$source.".php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator - Hệ thống quản trị nội dung</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/button_hienthi.css" rel="stylesheet" type="text/css" />

<link href="font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="css/jquery.tagsinput.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.tagsinput.js" type="text/javascript"></script>
<script type="text/javascript" src="js/external.js"></script>
<script src="js/jquery.price_format.2.0.js" type="text/javascript"></script>
<script src="ckeditor/ckeditor.js"></script>
<!-- datetimepicker -->
<link href="css/jquery.datetimepicker.css" type="text/css" rel="stylesheet" />
<script src="js/jquery.datetimepicker.full.js" type="text/javascript"></script>

<!-- MultiUpload -->
<link href="js/plugins/multiupload/css/jquery.filer.css" type="text/css" rel="stylesheet" />
<link href="js/plugins/multiupload/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/plugins/multiupload/jquery.filer.min.js"></script>

<link rel="stylesheet" type="text/css" href="js/ModalWindowEffects/css/component.css" />
<script src="js/ModalWindowEffects/js/modernizr.custom.js"></script>


<link rel="stylesheet" type="text/css" href="css/select2.css" />
<script src="js/select2.js"></script>

</head>

<?php if(isset($_SESSION[$login_name]) && $_SESSION[$login_name]==true){ ?>  
<body style="min-height: 100vh;">

<style type="text/css" media="screen">
	html { background: transparent url(images/bg.jpg); }
</style>
<!-- Left side content -->    
<script type="text/javascript">
function onAddTag(tag) {
  alert("Added a tag: " + tag);
}
function onRemoveTag(tag) {
  alert("Removed a tag: " + tag);
}

function onChangeTag(input,tag) {
  alert("Changed a tag: " + tag);
}

$(function(){
	var num = $('#menu').children(this).length;
	for (var index=0; index<=num; index++)
	{
		var id = $('#menu').children().eq(index).attr('id');
		$('#'+id+' strong').html($('#'+id+' .sub').children(this).length);
		$('#'+id+' .sub li:last-child').addClass('last');
	}
	$('#menu .activemenu .sub').css('display', 'block');
	$('#menu .activemenu a').removeClass('inactive');
	$('.conso').priceFormat({
		limit: 13,
		prefix: '',
		centsLimit: 0
	});
	$('#tags_1').tagsInput({width:'auto'});
})
</script>
<style type="text/css">
<?php if($config['lang']=="vi"){?>
	.chonngonngu{
		display:none;
	}
<?php } ?>
</style>
<script type="text/javascript">
	$(document).ready(function() {
		$('#ten_vi').blur(function(event) {
			var vl = $(this).val();
			$.ajax({
				url: 'changeLink.php',
				type: 'POST',
				dataType: "JSON",
				data: {vl: vl},
				success: function(data){
					$('#tenkhongdau').attr("value",data.das);
				}
			})
		});
	});	
</script>
<script type="text/javascript">
	$(document).ready(function() {
		var h = $('html').height();

		if(h > 800){
			var nav = $('.chonngonngu');
			$(window).scroll(function () {
			  if ($(this).scrollTop() > 100) {
			    nav.parent('.widget').addClass("f-nav");
			  } else {
			    nav.parent('.widget').removeClass("f-nav");
			  }
			});
		}
	});
</script>
<div class="full_page">
	<div id="leftSide">
		<?php include _template."left_tpl.php";?>
	</div>
	<!-- Right side -->
    <div id="rightSide">
        <!-- Top fixed navigation -->
        <div class="topNav">
	        <?php include _template."header_tpl.php";?>
		</div>
		<div class="wrapper">
			<?php if($notice_admin!='') echo '<div class="nNote nFailure"><p>'.$notice_admin.'</p></div>';?>
			<?php include _template.$template."_tpl.php";?>
		</div>
	</div>
    <div class="clear"></div>
</div>

<script src="js/ajax_custom.js" type="text/javascript" charset="utf-8" async defer></script>
<script>
	function myFunction(event) { 
	    var x = event.target;
	    document.getElementById("demo").innerHTML = "Triggered by a " + x.tagName + " element";
	}
	$(document).ready(function() {
		
		

		$('.menu-bar').click(function(event) {
			if($(this).hasClass('showmenu')){
				$('#leftSide').removeClass('shomenu-x');
				$('span.close').removeClass('showclose');
				$(this).removeClass('showmenu');
			}else{
				$('#leftSide').addClass('shomenu-x');
				$(this).addClass('showmenu');
				$('span.close').addClass('showclose');
			}
		});
		$('span.close').click(function(event) {
			$('#leftSide').removeClass('shomenu-x');
			$(this).removeClass('showclose');
			$('.menu-bar').removeClass('showmenu');
		});
		$('.ck_editors').each(function(index, el) {
			var id = $(this).attr('id');
			CKEDITOR.replace( id, {
			height : 500,
			entities: false,
			skin: 'moono',
	        basicEntities: false,
	        entities_greek: false,
	        entities_latin: false,
			filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
			filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
			filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
			allowedContent:
				'h1 h2 h3 h4 h5 h6 p blockquote strong em;' +
				'a[!href];' +
				'img(left,right)[!src,alt,width,height];' +
				'table tr th td caption;' +
				'span{!font-family};' +
				'span{!color};' +
				'span(!marker);' +
				'del ins'
			});

		});

	});
	
</script>
</body>
<?php }else{?>
<body class="nobg loginPage">   
<style type="text/css" media="screen">
	html { background: transparent url(images/bg-login.gif); }
</style>
<?php include _template.$template."_tpl.php";?>

<div class="md-overlay"></div>
<!-- classie.js by @desandro: https://github.com/desandro/classie -->
<script src="js/ModalWindowEffects/js/classie.js"></script>
<script src="js/ModalWindowEffects/js/modalEffects.js"></script>

<!-- for the blur effect -->
<!-- by @derSchepp https://github.com/Schepp/CSS-Filters-Polyfill -->
<script>
	// this is important for IEs
	var polyfilter_scriptpath = '/js/';
</script>

<script src="js/ModalWindowEffects/js/cssParser.js"></script>
<script src="js/ModalWindowEffects/js/css-filters-polyfill.js"></script>
<script src="js/ajax_custom.js" type="text/javascript" charset="utf-8" async defer></script>
<script>
	$(document).ready(function() {
		
		$('.ck_editors').each(function(index, el) {
			var id = $(this).attr('id');
			CKEDITOR.replace( id, {
			height : 500,
			entities: false,
			skin: 'moono',
	        basicEntities: false,
	        entities_greek: false,
	        entities_latin: false,
			filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
			filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
			filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
			allowedContent:
				'h1 h2 h3 h4 h5 h6 p blockquote strong em;' +
				'a[!href];' +
				'img(left,right)[!src,alt,width,height];' +
				'table tr th td caption;' +
				'span{!font-family};' +
				'span{!color};' +
				'span(!marker);' +
				'del ins'
			});

		});

	});
	
</script>
</body>
<?php }?>






</html>

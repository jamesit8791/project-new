<!DOCTYPE html>
<html lang="vi">
<head>
<base href="http://<?=$config_url?>/">
<link rel="canonical" href="<?=getCurrentPageURL_CANO()?>" />
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- <meta name="viewport" content="width=1349"> -->
<link id="favicon" rel="shortcut icon" href="<?=_upload_hinhanh_l.$row_setting['bgtop']?>" type="image/x-icon" />
<title><?php if($title_bar!='') echo $title_bar; else echo $row_setting['title']; ?></title>
<meta name="description" content="<?php if($description_bar!='') echo $description_bar; else echo $row_setting['description']; ?>">
<meta name="keywords" content="<?php if($keyword_bar!='') echo $keyword_bar; else echo $row_setting['keywords']; ?>">
<?php if($template == '404'){ ?>
<meta name="robots" content="noindex,nofollow" />
<?php }else{ ?>
<meta name="robots" content="noodp,index,follow" />
<?php } ?>
<meta name="google" content="notranslate" />
<meta name='revisit-after' content='1 days' />
<meta name="geo.placename" content="<?=$row_setting['diachi_'.$lang]?>">
<meta name="author" content="<?=$row_setting['ten_'.$lang]?>">
<?=$row_setting['analytics']?>
<?=$share_facebook?>
<?php if($config['facebook-id']!=''){ ?>
<meta property="fb:app_id" content="<?=$config['facebook-id']?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="plugins/animate.css?v=<?=time()?>">
<link rel='stylesheet' id='owl-carousel-css'  href='css/owl.carousel.min.css?v=<?=time()?>' type='text/css' media='all' />
<link rel='stylesheet' id='owl-theme-css'  href='css/owl.theme.min.css?v=<?=time()?>' type='text/css' media='all' />
<link rel='stylesheet' id='owl-transitions-css'  href='css/owl.transitions.min.css?v=<?=time()?>' type='text/css' media='all' />
<link href="css/load.css?v=<?=time()?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css?v=<?=time()?>">
<link href="style.css?v=<?=time()?>" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="page-preloader-cover">
  <div class="bar"></div>
</div>
<?php if($_REQUEST['com']=='index' || $_REQUEST['com']==''){ ?>
<h1 class="hidden fn"><?=$row_setting['title']?></h1>
<?php } ?>


<div id="full-wrapper">
  <section class="header-bottom-page">
    <?php include_once _template."layout/header.php"; ?>
  </section><!-- /header -->
  <section class="header-mobile-page menu-fixed">
    <?php include_once _template."layout/header-mobile.php"; ?>
  </section><!-- /header-mobile -->
  <section id="template" class="template-page">
    <div class="container">
      <div class="box-page">
        <div class="right-page">
          <?php include_once _template.$template."_tpl.php";?>
        </div>
      </div>
    </div>
  </section><!-- /template -->
  <footer id="footer" class="footer-page" style="background: <?=$row_setting['maufooter']?>">
    <?php include_once _template."layout/footer.php"; ?>
  </footer><!-- /footer -->
  <?php include_once _template."layout/copy.php"; ?>
</div>


<script language="javascript" type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script type="text/javascript">
  var plugin_path = 'http://<?=$config_url?>/';
  var index = "<?=($source=='index') ? 'yes':'no'?>";
  var template = "<?=$template?>";
</script>
<script language="javascript" type="text/javascript" src="js/custom.js"></script>


<?php if($_GET['id'] || $template=='baiviet_detail'){ ?>
<script src="https://sp.zalo.me/plugins/sdk.js"></script>
<?php } ?>


<?php if ($source=='contact'){ ?>
<script src="https://www.google.com/recaptcha/api.js?render=<?=$config['key']?>"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('<?=$config['key']?>', { action: 'contact' }).then(function (token) {
            var recaptchaResponse = document.getElementById('recaptchaResponse');
            recaptchaResponse.value = token;
        });
    });
</script>
<?php } ?>

<script type="text/javascript">
  var active_youtube = "<?=youtobi($video_na[0]['links'])?>";
  var active_address = <?=($source=='index') ? '0':'1'?>;
</script>
<div id="fb-root"></div>
<script>
var fired = false;
window.addEventListener("scroll", function(){
if ((document.documentElement.scrollTop != 0 && fired === false) || (document.body.scrollTop != 0 && fired === false)) {
(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6&appId=1717833035126973";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
fired = true;
}
}, true);
</script>
<?=$schema?>
<?php //include_once _template."layout/popup.php"; ?>
<?php include_once _template."layout/menu_mobile.php"; ?>
<?php include_once _template."layout/chiduong.php"; ?>
<?php //include_once _template."layout/chatface.php"; ?>
</body>
</html>

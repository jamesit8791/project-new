 
  <section id="nav-bar" class=" clearfix">
    <?php include_once _template."layout/menu.php"; ?>
  </section>
  
  <?php if($source=='index'){ ?>
  <section id="slider" class="slider-page">
    <?php include_once _template."layout/slider_jssor.php"; ?>
  </section><!-- /slider -->
  <section id="construction" class="construction-page">
    <?php include_once _template."layout/construction.php"; ?>
  </section><!-- /catagory -->
  <section id="visao" class="visao-page" style="background: url(<?=_upload_hinhanh_l.$bg_visao['photo']?>) no-repeat top center; background-size: cover;">
    <?php include_once _template."layout/visao.php"; ?>
  </section><!-- /catagory -->
  <section id="dichvu" class="dichvu-page">
    <?php include_once _template."layout/dichvu.php"; ?>
  </section><!-- /catagory -->
  <section id="chinhanh" class="chinhanh-page">
    <?php include_once _template."layout/chinhanh.php"; ?>
  </section><!-- /catagory -->
  
  <section id="news" class="news-page">
    <?php include_once _template."layout/news.php"; ?>
  </section><!-- /about -->
 
  <?php }else{ ?>
  <section id="template" class="template-page">
    <?php include_once _template.$template."_tpl.php";?>
  </section><!-- /template -->
  <?php } ?>
  
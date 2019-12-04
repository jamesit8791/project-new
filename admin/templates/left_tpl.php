<div class="he_menu">
  <div class="logo">
    <span class="close">
      <i class="fa fa-minus-square" aria-hidden="true"></i> Close
    </span>
    <a href="#" target="_blank" onclick="return false;"> <img src="images/logo.png"  alt="" /> </a></div>
  <div class="nav_menu">Menu</div>
  <div class="nav-divider"></div>
<div class="sidebarSep mt0"></div>
<!-- Left navigation -->
<ul id="menu" class="nav">
  <li class="dash" id="menu1">
    <a class=" active" title="" href="index.php">
      <span>
        <i class="fa fa-angle-double-right" aria-hidden="true"></i> Trang chủ
      </span>
    </a>
  </li>
  <li class="template_li<?php if($_GET['com']=='info' || $_GET['com']=='product') echo ' activemenu' ?>" id="menudv"><a href="#" title="" class="exp"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i> Trang sản phẩm</span><strong></strong></a>
    <ul class="sub">
       <li<?php if($_GET['act']=='man_list' && $_GET['type']=='san-pham') echo ' class="this"' ?>><a href="index.php?com=product&act=man_list&type=san-pham">Quản lý sản phẩm cấp 1</a></li>
       <li<?php if($_GET['act']=='man_cat' && $_GET['type']=='san-pham') echo ' class="this"' ?>><a href="index.php?com=product&act=man_cat&type=san-pham">Quản lý sản phẩm cấp 2</a></li>
       <li<?php if($_GET['act']=='man' && $_GET['type']=='san-pham') echo ' class="this"' ?>><a href="index.php?com=product&act=man&type=san-pham">Quản lý sản phẩm</a></li>
     </ul>
  </li>
  <li class="template_li<?php if($_GET['com']=='info' || $_GET['com']=='baiviet') echo ' activemenu' ?>" id="menu3"><a href="#" title="" class="exp"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i> Trang bài viết</span><strong></strong></a>
    <ul class="sub">
        <li<?php if($_GET['act']=='man' && $_GET['type']=='chinh-sach') echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man&type=chinh-sach">Quản lý chính sách</a></li>
        <li<?php if($_GET['act']=='man' && $_GET['type']=='vi-sao') echo ' class="this"' ?>><a href="index.php?com=baiviet&act=man&type=vi-sao">Quản lý vì sao</a></li>
     </ul>
  </li>
  
  
  <li class="setting_li<?php if($_GET['com']=='seo') echo ' activemenu' ?>" id="menuseogonl"><a href="#" title="" class="exp"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i> SEO</span><strong></strong></a>
    <ul class="sub">
      <li<?php if($_GET['com']=='seo' && $_GET['act']=='san-pham') echo ' class="this"' ?>><a href="index.php?com=seo&act=capnhat&type=san-pham">Seo sản phẩm</a></li>
      <li<?php if($_GET['com']=='seo' && $_GET['act']=='chinh-sach') echo ' class="this"' ?>><a href="index.php?com=seo&act=capnhat&type=chinh-sach">Seo chính sách</a></li>
      <li<?php if($_GET['com']=='seo' && $_GET['act']=='lien-he') echo ' class="this"' ?>><a href="index.php?com=seo&act=capnhat&type=lien-he">Seo liên hệ</a></li>
    </ul>
  </li>
  <li class="gallery_li<?php if($_GET['com']=='photo' || $_GET['com']=='album' || $_GET['com']=='video') echo ' activemenu' ?>" id="menu8"><a href="#" title="" class="exp"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i> Slider - đối tác</span><strong></strong></a>
    <ul class="sub">
      <li<?php if($_GET['com']=='photo' && $_GET['type']=='slider') echo ' class="this"' ?>><a href="index.php?com=photo&act=man_photo&type=slider" title="">Hình ảnh slider</a></li>
      <li<?php if($_GET['com']=='photo' && $_GET['type']=='doitac') echo ' class="this"' ?>><a href="index.php?com=photo&act=man_photo&type=doitac" title="">Hình ảnh đối tác</a></li>
    </ul>
  </li>
  <li class="template_li<?php if($_GET['com']=='bannerqc') echo ' activemenu' ?>" id="menuxsas9"><a href="#" title="" class="exp"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i> Hình ảnh - nhận tin</span><strong></strong></a>
    <ul class="sub">
      
      <li<?php if($_GET['type']=='logo') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=logo" title="">Logo</a></li>
        <!-- <li<?php if($_GET['type']=='popup') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=popup" title="">Popup</a></li> -->
      <!-- <li<?php if($_GET['type']=='bocongthuong') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=bocongthuong" title="">Hình bộ công thương</a></li> -->
      <li<?php if($_GET['type']=='hinhdaidien') echo ' class="this"' ?>><a href="index.php?com=bannerqc&act=capnhat&type=hinhdaidien" title="">Hình đại diện share link</a></li>
    </ul>
  </li>

  <li class="template_li<?php if($_GET['com']=='setting' || $_GET['com']=='company' || $_GET['com']=='newsletter') echo ' activemenu' ?>" id="menu10"><a href="#" title="" class="exp"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i> Thông tin công ty</span><strong></strong></a>
    <ul class="sub">
      <li<?php if($_GET['com']=='newsletter') echo ' class="this"' ?>><a href="index.php?com=newsletter&act=man" title="">Đăng ký nhận tin</a></li>
      <li<?php if($_GET['com']=='yahoo') echo ' class="this"' ?>><a href="index.php?com=yahoo&act=man" title="">Danh sách tư vấn</a></li>
     <li<?php if($_GET['com']=='company' && $_GET['type']=='footer') echo ' class="this"' ?>><a href="index.php?com=company&act=capnhat&type=footer" title="">Thông tin footer</a></li>
      <li<?php if($_GET['com']=='setting') echo ' class="this"' ?>><a href="index.php?com=setting&act=capnhat" title="">Cấu hình chung</a></li>
    </ul>
  </li>

  <li class="setting_li<?php if($_GET['com']=='database' || $_GET['com']=='backup' || $_GET['com']=='user') echo ' activemenu' ?>" id="menutttk12"><a href="#" title="" class="exp"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i> Cấu hình website</span><strong></strong></a>
    <ul class="sub">
      <li<?php if($_GET['com']=='user' && $_GET['act']=='admin_edit') echo ' class="this"' ?>><a href="index.php?com=user&act=admin_edit">Thông tin Tài khoản</a></li>
    </ul>
  </li>
</ul>
</div>

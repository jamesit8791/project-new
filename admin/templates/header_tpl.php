<?php
  $d->reset();
  $sql = "SELECT COUNT(*) as num FROM #_contact where view=0 ";
  $d->query($sql);
  $row_lienhe = $d->fetch_array();

  $d->reset();
  $sql = "SELECT COUNT(*) as num FROM #_order where view=0 ";
  $d->query($sql);
  $row_giohang = $d->fetch_array();

  //$tong_count = $row_lienhe['num'] + $row_giohang['num'];
  $tong_count = $row_lienhe['num'] + 0;
?>
<div class="wrapper">
  <div class="welcome menu-bar"><span><i class="fa fa-bars" aria-hidden="true"></i> Menu</span></div>
  <div class="welcome"><span><i class="fa fa-user" aria-hidden="true"></i> Xin chào, <?=$_SESSION['login']['username']?>!</span></div>
  <div class="userNav">
    <ul>
        <!-- <li><a href="index.php?com=user&act=man" title=""><span>Quản trị thành viên quản trị</span></a></li>
        <li><a href="index.php?com=phanquyen&act=man" title=""><span>Quản trị phân quyền</span></a></li>
        <li><a href="index.php?com=thanhvien&act=man" title=""><span>Quản trị thành viên website</span></a></li> -->
        <li><a href="http://<?=$config_url?>" class="tipS" original-title="Vào website" target="_blank"><img src="./images/icons/topnav/mainWebsite.png" alt="" /><span>Vào trang web</span></a></li>
        <li><a href="index.php?com=user&act=admin_edit" class="tipS" original-title="Thông tin tài khoản" title=""><img src="images/icons/topnav/profile.png" alt="" /><span>Thông tin tài khoản</span></a></li>
        <li class="ddnew">
          <a title=""><img src="images/icons/topnav/messages.png" class="tipS" original-title="Thông báo" alt="" /><span>Thông báo</span><span class="numberTop"><?=$tong_count?></span></a>
            <ul class="userMessage">
              <li>
                <a href="index.php?com=contact&act=man" title="" class="sInbox"><span>Liên hệ</span> <span class="numberTop" style="float:none; display:inline-block"><?=$row_lienhe['num']?></span></a>
              </li>
              
              <!-- <li>
                <a href="index.php?com=order&act=man" title="" class="sInbox"><span>Đơn hàng</span> <span class="numberTop" style="float:none; display:inline-block"><?=$row_giohang['num']?></span></a>
              </li> -->
              
            </ul>
        </li>
        <li><a href="index.php?com=user&act=logout" title=""><img src="images/icons/topnav/logout.png" alt="" /><span>Đăng xuất</span></a></li>
    </ul>
  </div>
  <div class="clear"></div>
</div>
<?php //$_SESSION['login']['role']; ?>
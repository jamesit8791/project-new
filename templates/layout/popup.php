<?php
$popup = get_fetch_array("select photo_$lang as photo,link,hienthi from #_photo where com='popup'");
?>
<link type="text/css" rel="stylesheet" href="plugins/magnific-popup/magnific-popup.css" />
<script type="text/javascript" src="plugins/magnific-popup/jquer.magnific-popup.js"></script>
<?php if($popup['hienthi']==1 && $source=='index') { ?>
<a href="#popup" class="open-popup"></a>
<div id="popup" class="white-popup mfp-hide">
  <div class="content-popup t-center">
    <a href="<?=$popup['link']?>" title="<?=$row_setting['ten_'.$lang]?>">
      <img src="<?=_upload_hinhanh_l.$popup['photo']?>" alt="<?=$row_setting['ten_'.$lang]?>">
    </a>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('.open-popup').magnificPopup({
      type:'inline',
      midClick: true,
      showCloseBtn: true,
      closeOnBgClick: true,
      closeBtnInside: false
    });
    $('.open-popup').trigger('click');
  });
</script>
<?php } ?>

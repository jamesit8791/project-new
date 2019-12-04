<div class="container">
  <div class="title w-100">
    <h1><?=$title?></h1>
  </div>
  <div class="content mt-20 w-100 mb-20 bx-border">
    <div class="detail">
      <?=$row_detail['noidung_'.$lang]?>
    </div>
  </div>
  <div class="content mt-30 mb-30 product" id="gallery">
    <?php if(count($tintuc)>0){ ?>
    <div class="row ds-flex flex-start flex-wrap">
      <?php for($i=0;$i<count($tintuc);$i++){ ?>
      <div class="item mb-20 cl-4">
        <div class="img">
          <a data-fancybox="fancy" rev="<?=_upload_album_l.$tintuc[$i]['photo']?>" href="<?=_upload_album_l.$tintuc[$i]['photo']?>" title="<?=$tintuc[$i]['ten_'.$lang]?>">
            <img src="resize/280x220/1/<?=_upload_album_l.$tintuc[$i]['photo']?>" alt="<?=$tintuc[$i]['ten_'.$lang]?>">
          </a>
        </div>
      </div>
      <?php } ?>
    </div>
    <div class="row clearfix">
      <div class="item t-center">
        <div class="pagination"><?=$paging?></div>
      </div>
    </div>
    <?php }else{ ?>
    <div class="row">
      <div class="item t-center">
        <?=_tb?>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<div class="container">
  <div class="title">
    <h1><?=$title?></h1>
  </div>
  <div class="content mt-30 mb-30 product" id="slide-product">
    <?php if(count($tintuc)>0){ ?>
    <div class="row ds-flex flex-start flex-wrap">
      <?php for($i=0;$i<count($tintuc);$i++){ ?>
      <div class="item mb-20 cl-4">
        <div class="img">
          <a href="<?=$tintuc[$i]['tenkhongdau']?>" title="<?=$tintuc[$i]['ten_'.$lang]?>">
            <img src="resize/280x220/1/<?=_upload_album_l.$tintuc[$i]['photo']?>" alt="<?=$tintuc[$i]['ten_'.$lang]?>">
          </a>
        </div>
        <div class="desc t-center">
          <h3><a href="<?=$tintuc[$i]['tenkhongdau']?>" title="<?=$tintuc[$i]['ten_'.$lang]?>"><?=$tintuc[$i]['ten_'.$lang]?></a></h3>
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
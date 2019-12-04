<div class="container">
  <div class="title w-100">
    <h1><?=$title?></h1>
  </div>
  <div class="content mb-20 mt-20 clearfix">
     <?php if(count($tintuc)>0){ ?>
     <div class="row ds-flex flex-wrap flex-between">
        <?php for($i=0;$i<count($tintuc);$i++){ ?>
        <div class="news-i w-100 item">
          <div class="news-b w-100 ds-flex flex-wrap flex-between">
            <div class="img">
              <a href="<?=$tintuc[$i]['tenkhongdau']?>" title="<?=$tintuc[$i]['ten_'.$lang]?>">
                <img src="resize/600x400/1/<?=_upload_baiviet_l.$tintuc[$i]['photo']?>" alt="<?=$tintuc[$i]['ten_'.$lang]?>">
              </a>
            </div>
            <div class="desc">
              <h3>
                <a href="<?=$tintuc[$i]['tenkhongdau']?>" title="<?=$tintuc[$i]['ten_'.$lang]?>"><?=$tintuc[$i]['ten_'.$lang]?></a>
              </h3>
              <p class="mota">
                <?=catchuoi($tintuc[$i]['mota_'.$lang],120)?>
              </p>
              <p>
                <a href="<?=$tintuc[$i]['tenkhongdau']?>" title="Xem thêm">Xem thêm</a>
              </p>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <div class="row">
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
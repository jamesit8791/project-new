<article class="top-detail">
  <div class="container">
    <div class="content pt-20 mb-20">
      <div class="m-detail">
        <div class="detail mb-10">
          <div class="author">
           <h1><?=$title?></h1>
          </div>
          <div class="author">
            <p>Đăng bởi: <strong>Admin</strong>, ngày <?=date('d/m/Y H:i A', $row_detail['ngaytao'])?></p>
          </div>
          <div class="desc mt-10">
            <?php if($row_detail['noidung_'.$lang]==''){ ?>
            <p><?=_tb?></p>
            <?php }else{ ?>
            <?=stripcslashes($row_detail['noidung_'.$lang])?>
            <?php } ?>
          </div>
        </div>
        <div class="detail mt-20">
          <div class="socialmediaicons ds-flex">
              <!-- Twitter -->
              <a href="https://twitter.com/share?url=<?=getCurrentPageURL()?>" target="_blank" rel="nofollow" class="fa fa-twitter"></a>
              <a href="https://www.facebook.com/sharer.php?u=<?=getCurrentPageURL()?>" target="_blank" rel="nofollow" class="fa fa-facebook"></a>
              <a href="https://plus.google.com/share?url=<?=getCurrentPageURL()?>" target="_blank" rel="nofollow" class="fa fa-google"></a>
              <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?=getCurrentPageURL()?>" target="_blank" rel="nofollow" class="fa fa-linkedin"></a>
              <a target="_blank" rel="nofollow" class="fa bg-info"><div class="zalo-share-button" data-href="<?=getCurrentPageURL()?>" data-oaid="<?=$config['zalo-id']?>" data-layout="2" data-color="blue" data-customize=false></div></a>
              <a href="mailto:?Subject=<?=$row_setting['email']?> <?=getCurrentPageURL()?>" rel="nofollow" class="fa fa-envelope"></a>
              <a href="javascript:;" onclick="window.print()" rel="nofollow" class="fa fa-print"></a>
          </div> 
        </div>
      </div>
    </div>
  </div>
</article>

<div class="container">
  <?php if($com!='chinh-sach'){ ?>
  <div class="title mt-20">
    <h4>Có thể bạn quan tâm</h4>
  </div>
  <div class="content mb-20 mt-20 clearfix">
    <?php if(count($tintuc_khac)>0){ ?>
   <div class="row ds-flex flex-wrap flex-between">
      <?php for($i=0;$i<count($tintuc_khac);$i++){ ?>
      <div class="news-i w-100 item">
        <div class="news-b w-100 ds-flex flex-between">
          <div class="img">
            <a href="<?=$tintuc_khac[$i]['tenkhongdau']?>" title="<?=$tintuc_khac[$i]['ten_'.$lang]?>">
              <img src="resize/600x400/1/<?=_upload_baiviet_l.$tintuc_khac[$i]['photo']?>" alt="<?=$tintuc_khac[$i]['ten_'.$lang]?>">
            </a>
          </div>
          <div class="desc">
            <h3>
              <a href="<?=$tintuc_khac[$i]['tenkhongdau']?>" title="<?=$tintuc_khac[$i]['ten_'.$lang]?>"><?=$tintuc_khac[$i]['ten_'.$lang]?></a>
            </h3>
            <p class="mota">
              <?=catchuoi($tintuc_khac[$i]['mota_'.$lang],140)?>
            </p>
            <p>
              <a href="<?=$tintuc_khac[$i]['tenkhongdau']?>" title="Xem thêm">Xem thêm</a>
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
  <?php } ?>
</div>
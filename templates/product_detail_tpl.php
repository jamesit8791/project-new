<div class="bg-white pd-10">
  <div class="title mb-20">
    <h1><?=$row_detail['ten_'.$lang]?></h1>
  </div>
  <div class="content">
     <div class="row ds-flex flex-wrap flex-start">
        <div class="item w-50 detail-left" id="detail-product">
          <div class="images_galley">
              <a href="<?= _upload_product_l.$row_detail['photo']?>" class="MagicZoom" id="Zoom-1" data-options="variableZoom: true;expand: off; hint: always; " >
                  <img src="<?= _upload_product_l.$row_detail['photo']?>" alt="<?=$row_detail['ten_'.$lang]?>"/>
              </a>
          </div>
          <?php if(count($hinhanh_sp)>0){ ?>
          <div class="images_list mt-5">
              <div class="row1 slickDetail">
                  <div>
                      <div class="item1 detail-img">
                          <a data-zoom-id="Zoom-1" href="http://<?=$config_url?>/<?=_upload_product_l.$row_detail['photo']?>"  data-image="http://<?=$config_url?>/<?=_upload_product_l.$row_detail['photo']?>">
                              <img src="http://<?=$config_url?>/resize/141x90/1/<?=_upload_product_l.$row_detail['photo']?>" alt="<?=$row_detail['ten_'.$lang]?>">
                          </a>
                      </div>
                  </div>
                  <?php for($i=0;$i<count($hinhanh_sp);$i++) { ?>
                  <div>
                      <div class="item1 detail-img">
                          <a data-zoom-id="Zoom-1" href="http://<?=$config_url?>/<?=_upload_product_l.$hinhanh_sp[$i]['photo']?>"  data-image="http://<?=$config_url?>/<?=_upload_product_l.$hinhanh_sp[$i]['photo']?>">
                              <img src="http://<?=$config_url?>/resize/141x90/1/<?=_upload_product_l.$hinhanh_sp[$i]['photo']?>" alt="<?=$row_detail['ten_'.$lang]?>">
                          </a>
                      </div>
                  </div>
                  <?php } ?>
              </div>
          </div>
          <?php } ?>
        </div>
        <div class="item w-50 detail-right">
          <ul class="product-list-detail">
            <li class="ds-flex flex-start"><span class="mr-10"><?=_code_product?>:</span><span class="masp"><?=$row_detail['masp']?></span></li>
            <li class="ds-flex flex-start"><span class="mr-10"><?=_count_view?>:</span><span><?=$row_detail['luotxem']?></span></li>
            <li class="ds-flex flex-start flex-align-center">
              <p class="price-detail mr-10">
                <span class="price"><?=($row_detail['giaban']!=0) ? number_format($row_detail['giaban'],0, ',', '.').' đ' : _contact ?></span>
              </p>
              <?php if($row_detail['giacu']!=0){ ?>
              <p class="price-detail">
                <span class="price-old"><?=_price_old?>: </span><span class="price-old td-line-through"><?=number_format($row_detail['giacu'],0, ',', '.')?>đ</span> <span class="price-old">(<?=_saving?> <?=giamgia($row_detail['giacu'],$row_detail['giaban'])?>)</span>
              </p>
              <?php } ?>
            </li>
            <?php if($row_detail['mota_'.$lang]!=''){ ?>
            <li>
              <div class="detail-bd">
                <?= ($row_detail['mota_'.$lang]!='') ? $row_detail['mota_'.$lang]:'' ?>
              </div>
            </li>
            <?php } ?>
            <li>
              <div class="socialmediaicons ds-flex">
                <a href="https://twitter.com/share?url=<?=getCurrentPageURL()?>" target="_blank" rel="nofollow" class="fa fa-twitter"></a>
                <a href="https://www.facebook.com/sharer.php?u=<?=getCurrentPageURL()?>" target="_blank" rel="nofollow" class="fa fa-facebook"></a>
                <a href="https://plus.google.com/share?url=<?=getCurrentPageURL()?>" target="_blank" rel="nofollow" class="fa fa-google"></a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?=getCurrentPageURL()?>" target="_blank" rel="nofollow" class="fa fa-linkedin"></a>
                <a target="_blank" rel="nofollow" class="fa bg-info">
                    <div class="zalo-share-button" data-href="<?=getCurrentPageURL()?>" data-oaid="<?=$config['zalo-id']?>" data-layout="2" data-color="blue" data-customize=false></div>
                </a>
                <a href="mailto:?Subject=<?=$row_setting['email']?> <?=getCurrentPageURL()?>" rel="nofollow" class="fa fa-envelope"></a>
                <a href="javascript:;" onclick="window.print()" rel="nofollow" class="fa fa-print"></a>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="desc mt-30 mb-30">
        <div class="tab-box clearfix">
          <h4 class="detail-title">
            <?=_info_details?>
          </h4>
          <div class="tabs-content mb-20" id="tabs1">
              <div class="detail-bd"><?= ($row_detail['noidung_'.$lang]!='') ? stripslashes($row_detail['noidung_'.$lang]):_tb ?></div>
          </div>
          <h4 class="detail-title">
            <?=_comment?>
          </h4>
          <div class="tabs-content" id="tabs2">
              <div class="detail-bd"><div class="fb-comments" data-href="<?=getCurrentPageURL()?>" data-width="100%" data-numposts="5"></div></div>
          </div>
        </div>
      </div>
  </div>
</div>
<div class="title mt-10">
  <h3><?=_related_products?></h3>
</div>
<div class="content mt-10 mb-10" id="slide-product">
  <?php if(count($product)>0){ ?>
  <div class="product ds-flex flex-start flex-wrap">
    <?php for($i=0;$i<count($product);$i++){ ?>
    <div class="cl-4">
      <div class="box">
        <div class="img">
          <a href="<?=$product[$i]['tenkhongdau']?>" title="<?=$product[$i]['ten_'.$lang]?>">
            <img src="resize/300x250/2/<?=_upload_product_l.$product[$i]['photo']?>" alt="<?=$product[$i]['ten_'.$lang]?>">
          </a>
        </div>
        <div class="desc t-center">
          <h3><a href="<?=$product[$i]['tenkhongdau']?>" title="<?=$product[$i]['ten_'.$lang]?>"><?=$product[$i]['ten_'.$lang]?></a></h3>
          <p>Thùng 110 ml</p>
          <p>Hạn sử dụng: 1 tháng</p>
          <p>
            <?php if($product[$i]['giaban']!=0){ ?>
            <span class="price"><?=number_format($product[$i]['giaban'],0, ',', '.')?> <u>đ</u></span> 
            <?php }else{ ?>
            Liên hệ: <span class="price"><?=$row_setting['hotline']?></span>
            <?php } ?>
            <?php if($product[$i]['giacu']!=0){ ?>
            <span class="price-old"><?=number_format($product[$i]['giacu'],0, ',', '.')?> <u>đ</u></span>
            <span class="sale"><?=giamgia($product[$i]['giacu'],$product[$i]['giaban'])?></span>
            <?php } ?>
          </p>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
  <div class="row ds-none">
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

<div class="desc row-support">
  <div class="desc-support" id="sliclSupport">
    <?php for($i=0;$i<count($yahoo);$i++){ ?>
    <div class="i">
      <div class="i-support" style="background: <?=$yahoo[$i]['maunen']?>">
        <p><img src="images/305A81BC.png" alt="<?=$yahoo[$i]['ten']?>"><?=$yahoo[$i]['ten']?></p>
        <p><?=$yahoo[$i]['dienthoai']?></p>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<div class="desc">
  <div class="desc-spbanchay">
    <h4>Nhóm sản phẩm bán chạy</h4>
    <div class="slickProductBC">
      <?php for($i=0;$i<count($sanphamcm_nb);$i++){ ?>
      <div>
          <div class="i">
            <div class="img">
              <a href="<?=$sanphamcm_nb[$i]['tenkhongdau']?>" title="<?=$sanphamcm_nb[$i]['ten']?>">
                <img src="resize/100x100/2/<?=_upload_product_l.$sanphamcm_nb[$i]['photo']?>" alt="<?=$sanphamcm_nb[$i]['ten']?>">
              </a>
            </div>
            <div class="des">
              <h3><a href="<?=$sanphamcm_nb[$i]['tenkhongdau']?>" title="<?=$sanphamcm_nb[$i]['ten']?>"><?=$sanphamcm_nb[$i]['ten']?></a></h3>
            </div>
          </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
<div class="desc mt-10">
  <div id="slickSliderIndex">
   <?php for($i=0;$i<count($slider);$i++){ ?>
        <div>
            <div onclick="window.location.href='<?=$slider[$i]['link']?>'" class="cursor-pointer">
                <img src="<?=_upload_hinhanh_l.$slider[$i]['photo']?>" alt="<?=$slider[$i]['ten']?>" class="ds-block"/>
            </div>
        </div>
    <?php } ?>
  </div>
</div>
<div class="desc mt-10">
  <?php for($k=0;$k<count($sanphamdm_nb);$k++){ $product_bc = get_result_array("select id,ten_$lang as ten,tenkhongdau,thumb,photo,giaban,giacu from #_product where hienthi=1 and type='san-pham' and id_list='".$sanphamdm_nb[$k]['id']."' order by stt asc,id desc limit 0,3"); $counx = get_fetch_array("select count(id) as dem from #_product where hienthi=1 and type='san-pham' and id_list='".$sanphamdm_nb[$k]['id']."' order by stt asc,id desc"); $product_rand = get_fetch_array("select id,ten_$lang as ten,tenkhongdau,thumb,photo,giaban,giacu from #_product where hienthi=1 and type='san-pham' and id_list='".$sanphamdm_nb[$k]['id']."' order by rand() limit 0,1");?>
  <div class="title">
    <h3><?=$sanphamdm_nb[$k]['ten']?></h3>
  </div>
  <div class="content mt-10 mb-10 product">
    <div class="product ds-flex flex-start flex-wrap" id="slide-product<?=$sanphamdm_nb[$k]['id']?>">
      <div class="cl-4">
        <div class="box">
         <div class="img-adv">
           <a href="<?=$sanphamdm_nb[$k]['tenkhongdau']?>" title="<?=$sanphamdm_nb[$k]['ten']?>">
             <img src="<?=_upload_product_l.$sanphamdm_nb[$k]['photo']?>" alt="<?=$sanphamdm_nb[$k]['ten']?>">
           </a>
         </div>
        </div>
      </div>
      <?php for($i=0;$i<count($product_bc);$i++){ ?>
        <div class="cl-4">
          <div class="box">
            <div class="img">
              <a href="<?=$product_bc[$i]['tenkhongdau']?>" title="<?=$product_bc[$i]['ten']?>">
                <img src="resize/300x250/2/<?=_upload_product_l.$product_bc[$i]['photo']?>" alt="<?=$product_bc[$i]['ten']?>">
              </a>
            </div>
            <div class="desc t-center">
              <h3><a href="<?=$product_bc[$i]['tenkhongdau']?>" title="<?=$product_bc[$i]['ten']?>"><?=$product_bc[$i]['ten']?></a></h3>
              <p>Thùng 110 ml</p>
              <p>Hạn sử dụng: 1 tháng</p>
              <p>
                <?php if($product_bc[$i]['giaban']!=0){ ?>
                <span class="price"><?=number_format($product_bc[$i]['giaban'],0, ',', '.')?> <u>đ</u></span> 
                <?php }else{ ?>
                Liên hệ: <span class="price"><?=$row_setting['hotline']?></span>
                <?php } ?>
                <?php if($product_bc[$i]['giacu']!=0){ ?>
                <span class="price-old"><?=number_format($product_bc[$i]['giacu'],0, ',', '.')?> <u>đ</u></span>
                <span class="sale"><?=giamgia($product_bc[$i]['giacu'],$product_bc[$i]['giaban'])?></span>
                <?php } ?>

              </p>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    <div class="xemthem-page" data-idlist="<?=$sanphamdm_nb[$k]['id']?>" data-total="<?=$counx['dem']?>" data-subtotal="<?=($counx['dem']-count($product_bc))?>" data-showed="<?=count($product_bc)?>">
      <span>Xem thêm <?=($counx['dem']-count($product_bc))?> sản phẩm khuyến mãi</span>
    </div>
  </div>
  <?php } ?>
</div>

<div class="desc mt-10">
  <div class="desc-visao">
    <div class="slickViSao">
      <?php for($i=0;$i<count($visao);$i++){ ?>
      <div>
          <div class="item_visao">
            <div class="img">
              <span>
                <img src="resize/65x64/2/<?=_upload_baiviet_l.$visao[$i]['photo']?>" alt="<?=$visao[$i]['ten']?>">
              </span>
            </div>
            <div class="desc">
              <h3><?=$visao[$i]['ten']?></h3>
            </div>
          </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>

<div class="desc mt-20 mb-20">
  <div class="desc-partner">
    <div class="title1">
      <h5>Đối tác khách hàng</h5>
    </div>
    <div class="box-partner mt-10" id="partnerSlick">
      <?php for($i=0;$i<count($partner);$i++){ ?>
      <div>
        <div class="img partner-page">
          <a href="<?=$partner[$i]['link']?>" title="<?=$partner[$i]['ten']?>">
            <img src="resize/146x100/2/<?=_upload_hinhanh_l.$partner[$i]['photo']?>" alt="<?=$partner[$i]['ten']?>">
          </a>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
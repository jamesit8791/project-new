<div class="title">
  <h1 class="bgc"><?=$title?></h1>
</div>
<div class="content mt-10 mb-10 product" id="slide-product">
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
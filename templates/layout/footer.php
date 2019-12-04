<div class="container">
  <div class="row ds-flex flex-between flex-wrap">
    <div class="item i-footer">
      <h6>Thông tin công ty</h6>
      <?=$footer['noidung']?>
    </div>
    <div class="item i-footer">
      <h6>Chính sách hỗ trợ</h6>
      <ul class="list-footer">
        <?php for($i=0;$i<count($chinhsach);$i++){ ?>
        <li><a href="<?=$chinhsach[$i]['tenkhongdau']?>" title="<?=$chinhsach[$i]['ten']?>">- <?=$chinhsach[$i]['ten']?></a></li>
        <?php } ?>
      </ul>
    </div>
    <div class="item i-footer">
      <div class="fb-page" data-href="<?=$row_setting['facebook']?>" data-width="466" data-height="247" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?=$row_setting['facebook']?>"><a href="<?=$row_setting['facebook']?>"><?=$row_setting['ten_'.$lang]?></a></blockquote></div></div>
    </div>
  </div>
</div>
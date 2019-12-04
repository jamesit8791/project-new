<script type="text/javascript">   
  $(document).ready(function() {
    $('.chonngonngu li a').click(function(event) {
      var lang = $(this).attr('href');
      $('.chonngonngu li a').removeClass('active');
      $(this).addClass('active');
      $('.lang_hidden').removeClass('active');
      $('.lang_'+lang).addClass('active');
      return false;
    });
  });

</script>
<div class="wrapper">
  <div class="control_frm">
      <div class="bc">
          <ul id="breadcrumbs" class="breadcrumbs">
            <li><a href="index.php?com=bannerqc&act=capnhat<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span><?=$config_info['title']?></span></a></li>
            <li class="current"><a href="" title=""><span><?=_title?></span></a></li>
          </ul>
          <div class="clear"></div>
      </div>
  </div>
  <form name="supplier" id="validate" class="form" action="index.php?com=bannerqc&act=save<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
    <div class="mtop0">
      <div class="oneOne">
        <div class="widget mtop0">
          <div class="title chonngonngu" style="border-bottom: 0px solid transparent">
            <ul>
              <?php  foreach ($config['lang'] as $k => $v){ ?>
              <li><a href="<?=$k?>" class="<?= ($k == 'vi') ? 'active': '' ?> tipS" title="<?=$v?>"><img src="./images/<?=$k?>.png" alt="" class="<?=changeTitle($v)?>" /><?=$v?></a></li>
              <?php } ?>
            </ul>
          </div>  
        </div>
      </div>
      <div class="oneOne">
        <div class="widget mtop0">
        <?php  foreach ($config['lang'] as $k => $v){ ?>
          <?php if($config_info['img']==true){ ?>
          <div class="formRow lang_hidden lang_<?=$k?>  <?= ($k == 'vi') ? 'active': '' ?>" >
            <label>Tải ảnh [<?=$v?>]:</label>
            <div class="formRight">
              <input type="file" id="file_<?=$k?>" name="file_<?=$k?>" />
              <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
              <br/>
              <br/>
              <span style="display: inline-block; line-height: 30px;color:#CCC;">
              Width: <?=$config_info['img-width']*$config_info['img-ratio']?>px - <?=$config_info['img-height']*$config_info['img-ratio']?>px
            </span>
            </div>
            <div class="clear"></div>
          </div>
          
          <div class="formRow lang_hidden lang_<?=$k?>  <?= ($k == 'vi') ? 'active': '' ?>">
            <label>Ảnh [<?=$v?>] hiện Tại :</label>
            <div class="formRight">
              <div class="mt10">
                  <img src="<?=_upload_hinhanh.$item['photo_'.$k]?>" alt="" width="220">
              </div>
            </div>
            <div class="clear"></div>
          </div>
        <?php } ?>
        <?php } ?>
        <?php if($config_info['link']==true){ ?>
        <div class="formRow">
            <label>Link:</label>
            <div class="formRight">
              <input type="text" name="link" title="Nhập link" id="link" class="tipS" value="<?=@$item['link']?>" />
            </div>
            <div class="clear"></div>
        </div>
        <?php } ?>
        <div class="formRow">
          <label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
          <div class="formRight">
            <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
          </div>
          <div class="clear"></div>
        </div>
        
        </div>
      </div>
    </div> 
    <input type="hidden" name="type" value="<?=$_GET['type']?>">
    <div class="formRow fixedBottom">
      <div class="formRight">
        <input type="submit" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
      </div>
      <div class="clear"></div>
    </div>
  </form>
</div>

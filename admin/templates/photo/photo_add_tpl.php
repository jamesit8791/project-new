<script type="text/javascript">		
	function TreeFilterChanged2(){		
				$('#validate').submit();		
	}	
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
<div class="control_frm">
    <div class="bc">
        <ul id="breadcrumbs" class="breadcrumbs">
            <li><a href="index.php?com=photo&act=man_photo<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>"><span><?=$config_info['title']?></span></a></li>
            <li class="current"><a href="#" onclick="return false;">Thêm <?=_title_dm?></a></li>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<form name="supplier" id="validate" class="form" action="index.php?com=photo&act=save_photo<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" method="post" enctype="multipart/form-data">
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
                <?php if($config_info['img']==true){ ?>
                <div class="formRow">
                    <label>Tải hình ảnh:</label>
                    <div class="formRight">
                        <input type="file" id="file" name="img" />
                        <img src="./images/question-button.png" alt="Upload hình" class="icon_question tipS" original-title="Tải hình ảnh (ảnh JPEG, GIF , JPG , PNG)">
                        <br/>
                        <br/>
                        <span style="display: inline-block; line-height: 30px;color:#CCC;">
                            Width: <?=$config_info['img-width']*$config_info['img-ratio']?>px - Height: <?=$config_info['img-height']*$config_info['img-ratio']?>px
                        </span>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php } ?>
                <?php if($config_info['link']==true){ ?>
                <div class="formRow">
                    <label>Link liên kết:</label>
                    <div class="formRight">
                        <input type="text" id="code_pro" name="link" value=""  title="Nhập link liên kết cho hình ảnh" class="tipS" />
                    </div>
                    <div class="clear"></div>
                </div>
                <?php } ?>

                <?php  foreach ($config['lang'] as $k => $v){ ?>
                <div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">
                    <label>Tiêu đề [<?=$v?>]</label>
                    <div class="formRight">
                        <input type="text" name="ten_<?=$k?>" title="Nhập tên danh mục" id="ten_<?=$k?>" class="tipS validate[required]" value="<?=@$item['ten_'.$k]?>" />
                    </div>
                    <div class="clear"></div>
                </div>
                <?php if($config_info['mota']==true){ ?>
                <div class="formRow lang_hidden lang_<?=$k?> <?= ($k == 'vi') ? 'active': '' ?>">
                    <label>Mô tả [<?=$v?>]</label>
                    <div class="ck_editor">
                        <textarea title="Nhập mô tả . " id="mota_<?=$k?>" name="mota_<?=$k?>"><?=@$item['mota_'.$k]?></textarea>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php } ?>
                <?php } ?>

                <div class="formRow">
                  <label>Hiển thị : <img src="./images/question-button.png" alt="Chọn loại" class="icon_que tipS" original-title="Bỏ chọn để không hiển thị danh mục này ! "> </label>
                  <div class="formRight">
                 
                    <input type="checkbox" name="hienthi" id="check1" value="1" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked="checked"':''?> />
                     <label>Số thứ tự: </label>
                      <input type="text" class="tipS" value="<?=isset($item['stt'])?$item['stt']:1?>" name="stt" style="width:40px; text-align:center;" onkeypress="return OnlyNumber(event)" original-title="Số thứ tự của danh mục, chỉ nhập số">
                  </div>
                  <div class="clear"></div>
                    </div>
            </div>
        </div>
    </div>
    <div class="formRow fixedBottom">
        <div class="formRight">
            <input type="hidden" name="type" id="id_this_type" value="<?=$_REQUEST['type']?>" />
            <input type="button" class="blueB" onclick="TreeFilterChanged2(); return false;" value="Hoàn tất" />
            <a href="index.php?com=photo&act=man_photo<?php if($_REQUEST['type']!='') echo'&type='. $_REQUEST['type'];?>" onClick="if(!confirm('Bạn có muốn thoát không ? ')) return false;" title="" class="button tipS redB" original-title="Thoát">Thoát</a>
        </div>
        <div class="clear"></div>
    </div>
	
</form>   
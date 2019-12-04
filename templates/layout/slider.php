<?php
    $d->reset();
    $sql = "select photo_vi as photo, mota_$lang as mota, link,ten_$lang as ten from #_photo where hienthi=1 and com='slider' order by stt asc,id desc";
    $d->query($sql);
    $slider = $d->result_array();
?>
<div id="slickSliderIndex">
    <?php for($i=0;$i<count($slider);$i++){ ?>
        <?php /*if($i==0){ ?>
        <div class="item_slider">
            <div class="slider-v">
                <video id="videochinh" autoplay loop muted playsinline>
                    <source src="<?=_upload_hinhanh_l.$row_setting['video']?>" type="video/mp4" class="video_slider">
                </video>
            </div>
        </div>
        <?php } */?>
        <div>
            <div onclick="window.location.href='<?=$slider[$i]['link']?>'" class="cursor-pointer">
                <img src="<?=_upload_hinhanh_l.$slider[$i]['photo']?>" alt="<?=$slider[$i]['ten']?>" class="ds-block"/>
            </div>
        </div>
    <?php } ?>
</div>
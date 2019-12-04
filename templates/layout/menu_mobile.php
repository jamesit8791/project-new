<nav id="menu-mobile" class="mm-menu mm-offcanvas">
	<?php if(count($sanphamdm)>0){ ?>
    <ul>
        <?php for($i=0;$i<count($sanphamdm);$i++){ $sanphamcat = get_result_array("select id,ten_$lang as ten,tenkhongdau from #_baiviet_cat where hienthi=1 and type='dich-vu' and id_list='".$sanphamdm[$i]['id']."' order by stt asc,id desc"); ?>
        <li>
            <a href="<?=$sanphamdm[$i]['tenkhongdau']?>" title="<?=$sanphamdm[$i]['ten']?>">
                <i class="fa fa-angle-double-right"></i> <?=$sanphamdm[$i]['ten']?>
            </a>
            <?php if(count($sanphamcat)>0){ ?>
            <ul>
                <?php for($m=0;$m<count($sanphamcat);$m++){ $sanphamitem = get_result_array("select id,ten_$lang as ten,tenkhongdau from #_baiviet_item where hienthi=1 and type='dich-vu' and id_cat='".$sanphamcat[$m]['id']."' order by stt asc,id desc"); ?>
                <li>
                    <a href="<?=$sanphamcat[$m]['tenkhongdau']?>" title="<?=$sanphamcat[$m]['ten']?>">
                        <?=$sanphamcat[$m]['ten']?>
                    </a>
                    <?php if(count($sanphamitem)>0){ ?>
		            <ul>
		                <?php for($k=0;$k<count($sanphamitem);$k++){ ?>
		                <li>
		                    <a href="<?=$sanphamitem[$k]['tenkhongdau']?>" title="<?=$sanphamitem[$k]['ten']?>">
		                        <?=$sanphamitem[$k]['ten']?>
		                    </a>
		                </li>
		                <?php } ?>
		            </ul>
		            <?php } ?>
                </li>
                <?php } ?>
            </ul>
            <?php } ?>
        </li>
        <?php } ?>
        </ul>
    <?php } ?>
</nav>

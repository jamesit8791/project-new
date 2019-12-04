<div class="container">
	<div class="p-relative menu-top">
		<div class="menu-dm p-relative">
			<p><span></span> Danh mục dịch vụ</p>
			<?php if(count($sanphamdm)>0){ ?>
	        <ul class="two">
	            <?php for($i=0;$i<count($sanphamdm);$i++){ $sanphamcat = get_result_array("select id,ten_$lang as ten,tenkhongdau from #_baiviet_cat where hienthi=1 and type='dich-vu' and id_list='".$sanphamdm[$i]['id']."' order by stt asc,id desc"); ?>
	            <li>
	                <a href="<?=$sanphamdm[$i]['tenkhongdau']?>" title="<?=$sanphamdm[$i]['ten']?>">
	                    <i class="fa fa-angle-double-right"></i> <?=$sanphamdm[$i]['ten']?>
	                </a>
	                <?php if(count($sanphamcat)>0){ ?>
		            <ul class="three">
		                <?php for($m=0;$m<count($sanphamcat);$m++){ $sanphamitem = get_result_array("select id,ten_$lang as ten,tenkhongdau from #_baiviet_item where hienthi=1 and type='dich-vu' and id_cat='".$sanphamcat[$m]['id']."' order by stt asc,id desc"); ?>
		                <li>
		                    <a href="<?=$sanphamcat[$m]['tenkhongdau']?>" title="<?=$sanphamcat[$m]['ten']?>">
		                        <?=$sanphamcat[$m]['ten']?>
		                    </a>
		                    <?php if(count($sanphamitem)>0){ ?>
				            <ul class="four">
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
		</div>
		<div class="menu-box ds-flex flex-wrap flex-start">
			<ul class="one ds-flex flex-wrap flex-start">
				<li><a href="" title="<?=_home?>"  class="<?=($source=='index') ? 'active':''?>"><?=_home?></a></li>
				<li><a href="gioi-thieu" class="<?=($com=='gioi-thieu') ? 'active':''?>" title="<?=_about?>"><?=_about?></a></li>
				<li><a href="tin-tuc" class="<?=($com=='tin-tuc') ? 'active':''?>" title="Tin tức">Tin tức</a></li>
				<li><a href="dich-vu" class="<?=($com=='dich-vu') ? 'active':''?>" title="Dịch vụ">Dịch vụ</a></li>
				<li><a href="hinh-anh" class="<?=($com=='hinh-anh') ? 'active':''?>" title="Hình ảnh">Hình ảnh</a></li>
				<li><a href="lien-he" class="<?=($com=='lien-he') ? 'active':''?>" title="<?=_contact?>"><?=_contact?></a></li>
			</ul>
		</div>
	</div>
</div>

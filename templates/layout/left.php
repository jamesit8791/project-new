<div class="left-item w-100">
	<div class="title-left">
		<h2><span></span> Danh mục sản phẩm</h2>
	</div>
	<div class="desc-left">
		<div class="menu-box">
			<?php if(count($sanphamdm)>0){ ?>
			<ul class="one">
				<?php for($i=0;$i<count($sanphamdm);$i++){
					$list_sanpham = get_result_array("select id,ten_$lang as ten,tenkhongdau from #_product_cat where hienthi=1 and type='san-pham' and id_list='".$sanphamdm[$i]['id']."' order by stt asc,id desc");
				?>
				<li>
					<a <?=(count($list_sanpham)==0) ? 'href="'.$sanphamdm[$i]['tenkhongdau'].'"':'class="click-menu cursor-pointer"'?>  title="<?=$sanphamdm[$i]['ten']?>">
						<?=$sanphamdm[$i]['ten']?> <i class="fa fa-angle-down"></i>
					</a>
					<?php if(count($list_sanpham)>0){ ?>
					<ul class="two">
						<?php for($k=0;$k<count($list_sanpham);$k++){ ?>
						<li>
							<a href="<?=$list_sanpham[$k]['tenkhongdau']?>" title="<?=$list_sanpham[$k]['ten']?>">
								<?=$list_sanpham[$k]['ten']?>
							</a>
						</li>
						<?php } ?>
					</ul>
					<?php } ?>
				</li>
				<?php } ?>
				</ul>
			<?php } ?>
		</div>
		<div class="search-box">
			<form  id="frm-search-left" name="frm-search-left" method="get" action="index.php">
			  <input type="hidden" name="com" value="search">
			  <input type="text" required name="keyword" id="keyword" class="input-control1 bx-border" value="<?=$_GET['keyword']?>" placeholder="<?=_search?>">
		      	<div class="button-search1">
					<i class="fa fa-search"></i>
				</div>
		    </form>
		</div>
		<div class="tienich-box">
			<?php for($i=0;$i<count($visao);$i++){ ?>
			<div class="it">
				<img src="resize/22x22/2/<?=_upload_baiviet_l.$visao[$i]['photo']?>" alt="<?=$visao[$i]['ten']?>"> <?=$visao[$i]['ten']?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
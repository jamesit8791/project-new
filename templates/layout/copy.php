<section id="copy">
	<div class="container">
		<div  class="copy">
			<p class="copy-text ds-inline-block t-left">2018 Copyright &copy; <?=$row_setting['ten_'.$lang]?> . All rights reserved. Design by NINA Co.,Ltd</p>
			<p class="copy-text ds-inline-block t-left">Đang online: <span><?php $count = count_online(); echo $count['dangxem'];?></span> | Trong ngày: <span><?=$today_visitors?></span> | Trong tháng: <span><?=$month_visitors?></span> | Tổng truy cập: <span><?=$all_visitors?></span></p>
		</div>
	</div>
</section>
<div class="container">
	<div class="title">
      <h1><?=$title?></h1>
    </div>
	<div class="content mt-30">
	   <div class="contact-item t-center bx-border">
			<?=stripcslashes($row_detail['noidung_'.$lang])?>
	   </div>
	   <div class="contact-item pt-20 bx-border">
			<form method="post" id="frm-contact" name="frm-contact" action="lien-he">
				<div class="row ds-flex flex-between flex-wrap">
					<div class="w-100 item row-contact mb-10">
						<input name="hoten" type="text" class="form-control" id="hoten" size="50" placeholder="<?=_name?>...." />
					</div>
					<div class="w-50 item row-contact mb-10">
						<input name="dienthoai" type="text" class="form-control" id="dienthoai" size="50" placeholder="<?=_phone?>..."  />
					</div>
					<div class="w-50 item row-contact mb-10">
						<input name="email" type="text" class="form-control" id="email" size="50" placeholder="<?=_email?>..." />
					</div>
					<div class="w-50 item row-contact mb-10">
						<input name="diachi" type="text"  class="form-control" size="50" id="diachi" placeholder="<?=_address?>..." />
					</div>
					<div class="w-50 item row-contact mb-10">
						<input name="tieude" type="text" class="form-control" id="tieude" size="50" placeholder="<?=_subject?>...." />
					</div>
					<div class="w-100 item row-contact mb-10">
						<textarea name="noidung" class="form-control" rows="5" id="noidung" placeholder="<?=_content?>" ></textarea>
					</div>
					<div class="item w-100 row-contact t-center">
						<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
						<input class="btn btn-primary t-uppercase" type="submit" id="btn-submit-contact" value="<?=_send?>"/>
						<input class="btn btn-danger t-uppercase" type="button" value="<?=_reset?>" onclick="document.frm_contact.reset();" />
					</div>
				</div>
			</form>
	   </div>
	</div>

	<div class="content clearfix">
		<div id="map-content">
			<?=$row_setting['toado']?>
		</div>
	</div>
</div>